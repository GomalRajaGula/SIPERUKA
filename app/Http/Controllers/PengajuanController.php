<?php

namespace App\Http\Controllers;

use App\Models\DetailPengajuan;
use App\Models\Pengajuan;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    /**
     * Show the form for creating a new room request.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        /** @var \Illuminate\Database\Eloquent\Collection|Ruangan[] $rooms */
        $rooms = Ruangan::query()->get();

        return view('mahasiswa.buat-pengajuan', compact('rooms'));
    }

    /**
     * Store a newly created room request in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_ruangan' => 'required',
            'tanggal_kegiatan' => 'required|date|after_or_equal:today',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'keperluan' => 'required|string|min:10',
            'file_dokumen_pendukung' => 'required|file|mimes:pdf|max:5120',
        ], [
            'id_ruangan.required' => 'Ruangan harus dipilih.',
            'tanggal_kegiatan.required' => 'Tanggal peminjaman harus diisi.',
            'tanggal_kegiatan.date' => 'Format tanggal tidak valid.',
            'tanggal_kegiatan.after_or_equal' => 'Tanggal peminjaman minimal hari ini.',
            'waktu_mulai.required' => 'Waktu mulai harus diisi.',
            'waktu_selesai.required' => 'Waktu selesai harus diisi.',
            'waktu_selesai.after' => 'Waktu selesai harus setelah waktu mulai.',
            'keperluan.required' => 'Keperluan kegiatan harus diisi.',
            'keperluan.min' => 'Keperluan kegiatan minimal 10 karakter.',
            'file_dokumen_pendukung.required' => 'Dokumen pendukung harus diunggah.',
            'file_dokumen_pendukung.mimes' => 'Dokumen pendukung harus berupa file PDF.',
            'file_dokumen_pendukung.max' => 'Ukuran dokumen pendukung maksimal 5 MB.',
        ]);

        // Save document file
        $filePath = null;
        if ($request->hasFile('file_dokumen_pendukung')) {
            $filePath = $request->file('file_dokumen_pendukung')->store('dokumen_pengajuan', 'public');
        }

        // Create Pengajuan
        /** @var Pengajuan $pengajuan */
        $pengajuan = Pengajuan::query()->create([
            'id_user' => Auth::id(),
            'file_dokumen_pendukung' => $filePath,
            'status' => 'pending',
        ]);

        // Create Detail Pengajuan
        DetailPengajuan::query()->create([
            'id_pengajuan' => $pengajuan->id,
            'id_ruangan' => $request->id_ruangan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
        ]);

        return redirect()->route('dashboard.mahasiswa')->with('success', 'Pengajuan peminjaman ruangan berhasil dikirim.');
    }

    /**
     * Show the printable permit letter (Surat Izin) for approved request (Mahasiswa).
     *
     * @param  int  $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function suratIzin($id)
    {
        $pengajuan = Pengajuan::with(['user', 'detailPengajuans.ruangan'])->findOrFail($id);

        // Ensure the request belongs to the authenticated user and is approved
        if ($pengajuan->id_user !== Auth::id() || $pengajuan->status !== 'approved') {
            return redirect()->route('dashboard.mahasiswa')->with('error', 'Anda tidak memiliki akses ke surat izin ini atau pengajuan belum disetujui.');
        }

        return view('mahasiswa.surat-izin', compact('pengajuan'));
    }

    /**
     * Show the printable permit letter (Surat Izin) for BAAK.
     *
     * @param  int  $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function suratIzinBaak($id)
    {
        $pengajuan = Pengajuan::with(['user', 'detailPengajuans.ruangan'])->findOrFail($id);

        if ($pengajuan->status !== 'approved') {
            return redirect()->route('dashboard.baak')->with('error', 'Pengajuan belum disetujui, surat izin belum tersedia.');
        }

        return view('mahasiswa.surat-izin', compact('pengajuan'));
    }

    /**
     * View the uploaded PDF document (for BAAK).
     *
     * @param  int  $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Illuminate\Http\RedirectResponse
     */
    public function downloadDokumenBaak($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        
        if (!$pengajuan->file_dokumen_pendukung) {
            return redirect()->back()->with('error', 'Dokumen pendukung tidak tersedia.');
        }

        $path = storage_path('app/public/' . $pengajuan->file_dokumen_pendukung);

        if (!file_exists($path)) {
            return redirect()->back()->with('error', 'File dokumen tidak ditemukan di server.');
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="Surat_Pengajuan_' . $pengajuan->id . '.pdf"'
        ]);
    }
}
