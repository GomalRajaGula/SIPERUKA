<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class SatpamController extends Controller
{
    /**
     * Display the Satpam dashboard.
     */
    public function dashboard()
    {
        return view('satpam.dashboard');
    }

    /**
     * Verify the QR Code / Electronic Permit code.
     */
    public function verifyQr(Request $request)
    {
        $request->validate([
            'kode_tte' => 'required|string',
        ]);

        // Query the pengajuan table along with user (pemohon) and room detail relations
        /** @var Pengajuan|null $pengajuan */
        $pengajuan = Pengajuan::query()->with(['user', 'detailPengajuans.ruangan']) // [CHANGED]
            ->where([['kode_tte', '=', $request->kode_tte]]) // [CHANGED]
            ->first();

        if (!$pengajuan) {
            return response()->json([
                'success' => false,
                'message' => 'Surat izin tidak ditemukan. Kode QR tidak terdaftar.'
            ], 404);
        }

        /** @var \App\Models\DetailPengajuan|null $detail */
        $detail = $pengajuan->detailPengajuans->first();
        
        $data = [
            'pemohon' => $pengajuan->user->nama,
            'ruangan' => $detail ? $detail->ruangan->nama_ruangan : '-',
            'tanggal' => $detail ? \Illuminate\Support\Carbon::parse($detail->tanggal_kegiatan)->translatedFormat('d F Y') : '-',
            'waktu' => $detail ? $detail->waktu_mulai . ' - ' . $detail->waktu_selesai : '-',
            'status' => $pengajuan->status,
            'kode_tte' => $pengajuan->kode_tte
        ];

        if ($pengajuan->status === 'approved') {
            return response()->json([
                'success' => true,
                'message' => 'Surat Izin Penggunaan Ruangan VALID.',
                'data' => $data
            ]);
        }

        // Return invalid status (e.g. pending or rejected)
        return response()->json([
            'success' => false,
            'message' => 'Surat Izin TIDAK VALID (Status: ' . strtoupper($pengajuan->status) . ').',
            'data' => $data
        ]);
    }
}
