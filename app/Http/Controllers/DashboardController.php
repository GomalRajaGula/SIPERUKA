<?php

namespace App\Http\Controllers;

use App\Models\DetailPengajuan;
use App\Models\Pengajuan;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    /**
     * Redirect users to their correct role-based dashboard.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $role = $user->role;

        switch ($role) {
            case 'mahasiswa':
                return redirect()->route('dashboard.mahasiswa');
            case 'baak':
                return redirect()->route('dashboard.baak');
            case 'satpam':
                return redirect()->route('dashboard.satpam');
            default:
                Auth::logout();
                return redirect()->route('login')->with('error', 'Role tidak valid.');
        }
    }

    /**
     * Mahasiswa Dashboard.
     */
    public function mahasiswa()
    {
        $userId = Auth::id();
        /** @var \Illuminate\Database\Eloquent\Collection|Pengajuan[] $pengajuans */
        $pengajuans = Pengajuan::query()->with(['detailPengajuans.ruangan'])
            ->where([['id_user', '=', $userId]])
            ->latest()
            ->get();

        $totalPeminjaman = $pengajuans->count();
        $menungguVerifikasi = $pengajuans->filter(fn($p) => $p->status === 'pending')->count();
        $telahDisetujui = $pengajuans->filter(fn($p) => $p->status === 'approved')->count();

        return view('mahasiswa.dashboard', compact('pengajuans', 'totalPeminjaman', 'menungguVerifikasi', 'telahDisetujui'));
    }

    /**
     * BAAK Dashboard.
     */
    public function baak(Request $request)
    {
        /** @var \Illuminate\Database\Eloquent\Builder $query */
        $query = Pengajuan::query()->with(['user', 'detailPengajuans.ruangan']);

        // Search by Student Name (nama) or NIM (username)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function (\Illuminate\Database\Eloquent\Builder $q) use ($search) {
                $q->where([['nama', 'like', "%{$search}%"]])
                  ->orWhere([['username', 'like', "%{$search}%"]]);
            });
        }

        // Filter by Room ID
        if ($request->filled('ruangan')) {
            $ruangan = $request->ruangan;
            $query->whereHas('detailPengajuans', function (\Illuminate\Database\Eloquent\Builder $q) use ($ruangan) {
                $q->where([['id_ruangan', '=', $ruangan]]);
            });
        }

        // Filter by Status
        if ($request->filled('status')) {
            $query->where([['status', '=', $request->status]]);
        }

        /** @var \Illuminate\Database\Eloquent\Collection|Pengajuan[] $pengajuans */
        $pengajuans = $query->latest()->get();

        // Calculate counts
        $totalIncoming = Pengajuan::query()->where([['status', '=', 'pending']])->count();
        $totalVerified = Pengajuan::query()->where([['status', '=', 'approved']])->count();
        $totalRejected = Pengajuan::query()->where([['status', '=', 'rejected']])->count();

        // All rooms for filter dropdown
        /** @var \Illuminate\Database\Eloquent\Collection|Ruangan[] $rooms */
        $rooms = Ruangan::query()->get();

        // (Mock data fallback removed for real synchronization)

        return view('baak.dashboard', compact(
            'pengajuans', 'totalIncoming', 'totalVerified', 'totalRejected', 'rooms'
        ));
    }

    // Mock pengajuans removed

    /**
     * Show pengajuan detail as JSON for BAAK modal.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function showDetail(int $id): JsonResponse
    {
        /** @var Pengajuan $pengajuan */
        $pengajuan = Pengajuan::query()->with(['user', 'detailPengajuans.ruangan'])->findOrFail($id);

        /** @var DetailPengajuan|null $detail */
        $detail = $pengajuan->detailPengajuans->first();

        return response()->json([
            'id'              => $pengajuan->id,
            'status'          => $pengajuan->status,
            'kode_tte'        => $pengajuan->kode_tte ?? '-',
            'file_dokumen'    => $pengajuan->file_dokumen_pendukung
                ? route('baak.pengajuan.dokumen', $pengajuan->id)
                : null,
            'pemohon'         => [
                'nama'     => $pengajuan->user?->nama ?? 'Unknown',
                'username' => $pengajuan->user?->username ?? 'N/A',
                'email'    => $pengajuan->user?->email ?? 'N/A',
            ],
            'detail'          => $detail ? [
                'ruangan'          => $detail->ruangan?->nama_ruangan ?? '-',
                'tanggal_kegiatan' => \Carbon\Carbon::parse($detail->tanggal_kegiatan)->translatedFormat('d F Y'),
                'waktu_mulai'      => substr($detail->waktu_mulai, 0, 5),
                'waktu_selesai'    => substr($detail->waktu_selesai, 0, 5),
            ] : null,
        ]);
    }

    /**
     * Approve Pengajuan
     *
     * @param  int  $id
     */
    public function approve(int $id)
    {
        /** @var Pengajuan $pengajuan */
        $pengajuan = Pengajuan::query()->findOrFail($id);

        // Generate TTE code
        $kodeTte = 'TTE-' . strtoupper(Str::random(10));

        $pengajuan->update([
            'status'   => 'approved',
            'kode_tte' => $kodeTte,
        ]);

        return redirect()->back()->with('success', 'Pengajuan #' . $id . ' berhasil disetujui dengan Kode TTE: ' . $kodeTte);
    }

    /**
     * Reject Pengajuan
     *
     * @param  Request  $request
     * @param  int  $id
     */
    public function reject(Request $request, int $id)
    {
        /** @var Pengajuan $pengajuan */
        $pengajuan = Pengajuan::query()->findOrFail($id);

        $pengajuan->update([
            'status' => 'rejected',
        ]);

        $reason = $request->input('alasan', 'Tidak ada alasan penolakan yang ditulis.');

        return redirect()->back()->with('info', 'Pengajuan #' . $id . ' telah ditolak. Alasan: ' . $reason);
    }

    /**
     * Satpam Dashboard.
     */
    public function satpam()
    {
        // Stats for today's activities
        $totalHariIni = DetailPengajuan::query()
            ->whereHas('pengajuan', fn(\Illuminate\Database\Eloquent\Builder $q) => $q->where([['status', '=', 'approved']]))
            ->where([['tanggal_kegiatan', '=', today()]])
            ->count();

        $sedangBerlangsung = DetailPengajuan::query()
            ->whereHas('pengajuan', fn(\Illuminate\Database\Eloquent\Builder $q) => $q->where([['status', '=', 'approved']]))
            ->where([
                ['tanggal_kegiatan', '=', today()],
                ['waktu_mulai', '<=', now()->format('H:i:s')],
                ['waktu_selesai', '>=', now()->format('H:i:s')]
            ])
            ->count();

        $akanDatang = DetailPengajuan::query()
            ->whereHas('pengajuan', fn(\Illuminate\Database\Eloquent\Builder $q) => $q->where([['status', '=', 'approved']]))
            ->where([['tanggal_kegiatan', '>', today()]])
            ->count();

        // Today's approved schedule
        /** @var \Illuminate\Database\Eloquent\Collection|Pengajuan[] $todaySchedules */
        $todaySchedules = Pengajuan::query()
            ->with(['user', 'detailPengajuans.ruangan'])
            ->where([['status', '=', 'approved']])
            ->whereHas('detailPengajuans', function (\Illuminate\Database\Eloquent\Builder $q) {
                $q->where([['tanggal_kegiatan', '=', today()]]);
            })
            ->get();

        // Fallback mock removed

        return view('satpam.dashboard', compact(
            'totalHariIni', 'sedangBerlangsung', 'akanDatang', 'todaySchedules'
        ));
    }

    // Mock schedules removed
}
