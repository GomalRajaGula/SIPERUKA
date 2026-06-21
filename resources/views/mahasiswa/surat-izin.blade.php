<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Izin Peminjaman Ruangan - PMJ-{{ str_pad($pengajuan->id, 4, '0', STR_PAD_LEFT) }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* A4 Page Styling */
        @page {
            size: A4;
            margin: 0;
        }
        body {
            background-color: #f1f5f9;
            font-family: 'Times New Roman', Times, serif;
        }
        .a4-page {
            width: 210mm;
            min-height: 297mm;
            background: white;
            margin: 10mm auto;
            padding: 20mm;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
        @media print {
            body {
                background-color: white;
            }
            .a4-page {
                margin: 0;
                padding: 15mm;
                box-shadow: none;
                width: 100%;
                min-height: 100%;
            }
            .no-print {
                display: none !important;
            }
        }
        .kop-surat {
            border-bottom: 3px solid black;
            padding-bottom: 4px;
            margin-bottom: 20px;
        }
        .kop-surat::after {
            content: '';
            display: block;
            border-bottom: 1px solid black;
            margin-top: 2px;
        }
    </style>
</head>
<body class="text-slate-900">

    <div class="fixed top-4 right-4 no-print flex gap-2">
        <button onclick="window.print()" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
            </svg>
            Print / Save as PDF
        </button>
        <button onclick="window.close()" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg font-semibold hover:bg-slate-300">
            Tutup
        </button>
    </div>

    <div class="a4-page">
        <!-- Kop Surat -->
        <div class="kop-surat flex items-center mb-6">
            <div class="w-24 h-24 flex items-center justify-center shrink-0">
                <!-- Fallback logo if image not available -->
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-2xl">
                    PNC
                </div>
            </div>
            <div class="flex-1 text-center px-4">
                <h1 class="text-xl font-bold uppercase tracking-wide">Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi</h1>
                <h2 class="text-2xl font-extrabold uppercase mt-1">Politeknik Negeri Cilacap</h2>
                <p class="text-sm mt-1">Jalan Dr. Soetomo No.1, Sidakaya - Cilacap 53212</p>
                <p class="text-sm">Telepon: (0282) 533329, Email: info@pnc.ac.id</p>
            </div>
            <div class="w-24 shrink-0"></div> <!-- Balancer for centering -->
        </div>

        <!-- Judul -->
        <div class="text-center mb-8">
            <h3 class="text-xl font-bold underline mb-1">SURAT IZIN PEMINJAMAN RUANGAN</h3>
            <p class="text-sm font-semibold">Nomor: PMJ-{{ str_pad($pengajuan->id, 4, '0', STR_PAD_LEFT) }}/BAAK/{{ date('Y') }}</p>
        </div>

        @php
            $detail = $pengajuan->detailPengajuans->first();
            $ruanganName = isset($detail->ruangan) ? $detail->ruangan->nama_ruangan : null;
            if (!$ruanganName && $detail) {
                $staticRooms = [
                    1 => 'Aula Utama H.1.1',
                    2 => 'Lab Komputer Terpadu',
                    3 => 'Ruang Rapat BAAK',
                    4 => 'Gedung Serba Guna (GSG)'
                ];
                $ruanganName = $staticRooms[$detail->id_ruangan] ?? 'Ruangan #' . $detail->id_ruangan;
            }
        @endphp

        <!-- Konten -->
        <div class="space-y-4 text-justify leading-relaxed">
            <p>Berdasarkan pengajuan perizinan peminjaman ruangan yang telah diajukan melalui Sistem Informasi Perizinan Ruangan Kampus (SIPERUKA), dengan ini BAAK memberikan izin kepada:</p>
            
            <table class="w-full ml-8 mb-4">
                <tr>
                    <td class="w-48 py-1">Nama</td>
                    <td class="w-4">:</td>
                    <td class="font-bold">{{ $pengajuan->user->nama ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="py-1">NIM / Identitas</td>
                    <td>:</td>
                    <td class="font-bold">{{ $pengajuan->user->username ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="py-1">Role</td>
                    <td>:</td>
                    <td class="capitalize">{{ $pengajuan->user->role ?? 'Mahasiswa' }}</td>
                </tr>
            </table>

            <p>Untuk menggunakan fasilitas ruangan kampus dengan rincian sebagai berikut:</p>

            <table class="w-full ml-8 mb-4">
                <tr>
                    <td class="w-48 py-1">Nama Ruangan</td>
                    <td class="w-4">:</td>
                    <td class="font-bold">{{ $ruanganName ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="py-1">Tanggal Kegiatan</td>
                    <td>:</td>
                    <td class="font-bold">{{ $detail ? \Carbon\Carbon::parse($detail->tanggal_kegiatan)->translatedFormat('l, d F Y') : 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="py-1">Waktu</td>
                    <td>:</td>
                    <td class="font-bold">{{ $detail ? substr($detail->waktu_mulai, 0, 5) . ' s.d ' . substr($detail->waktu_selesai, 0, 5) . ' WIB' : 'N/A' }}</td>
                </tr>
            </table>

            <p>Demikian surat izin ini dibuat untuk dapat dipergunakan sebagaimana mestinya. Harap menunjukkan surat izin ini (baik dicetak maupun digital) kepada petugas keamanan (Satpam) saat akan menggunakan ruangan.</p>

        </div>

        <!-- Tanda Tangan & QR Code -->
        <div class="mt-16 flex justify-between items-end">
            <div class="w-48 text-center">
                <p class="mb-2 text-sm font-semibold">Scan QR Code Validasi</p>
                <div class="border-2 border-slate-200 p-2 inline-block bg-white rounded-lg">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode($pengajuan->kode_tte) }}" alt="QR Code" class="w-24 h-24">
                </div>
                <p class="mt-2 text-xs font-mono font-bold text-slate-500">{{ $pengajuan->kode_tte }}</p>
            </div>
            
            <div class="w-64 text-center">
                <p>Cilacap, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p class="font-bold mb-16 mt-1">Kepala BAAK</p>
                <p class="font-bold underline decoration-2 underline-offset-4">Dokumen ditandatangani secara elektronik</p>
                <p class="text-sm mt-1">SIPERUKA PNC</p>
            </div>
        </div>
    </div>

    <!-- Auto Print Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Optional: Automatically trigger print dialog when opened
            // setTimeout(() => window.print(), 500);
        });
    </script>
</body>
</html>
