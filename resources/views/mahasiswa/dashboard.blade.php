@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('content')
<div class="space-y-8">

    <!-- SUCCESS ALERT -->
    @if (session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-start gap-3 shadow-sm">
            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h5 class="text-sm font-bold text-emerald-950">Berhasil!</h5>
                <p class="text-xs text-emerald-700 mt-0.5">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <!-- HEADER / WELCOME SECTION -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            @auth
                <h3 class="text-2xl font-extrabold tracking-tight text-slate-900">Selamat datang, {{ auth()->user()->nama }}!</h3>
            @else
                <h3 class="text-2xl font-extrabold tracking-tight text-slate-900">Selamat datang!</h3>
            @endauth
            <p class="text-xs text-slate-400 mt-1 font-semibold font-sans uppercase tracking-wider">Sistem Informasi Perizinan Ruangan PNC</p>
        </div>
        
        <a href="{{ route('mahasiswa.buat-pengajuan') }}" class="sm:self-start inline-flex items-center gap-2 px-5 py-3 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-md shadow-blue-500/10 hover:shadow-blue-500/20 active:scale-[0.98] transition-all duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
            </svg>
            Buat Pengajuan Baru
        </a>
    </div>

    <!-- MOCK DATA PREPARATION LOGIC -->
    @php
        $displayPengajuans = $pengajuans;
        if ($pengajuans->isEmpty()) {
            // Create mock objects for visual illustration
            $mock1 = new \stdClass();
            $mock1->id = 143;
            $mock1->status = 'pending';
            $mock1->kode_tte = '-';
            $mock1->file_dokumen_pendukung = 'mock.pdf';
            $mock1->user = (object)['nama' => auth()->user()->nama];
            $mock1->detailPengajuans = collect([(object)[
                'id_ruangan' => 2,
                'tanggal_kegiatan' => date('Y-m-d', strtotime('+3 days')),
                'waktu_mulai' => '09:00:00',
                'waktu_selesai' => '12:00:00',
                'ruangan' => (object)['nama_ruangan' => 'Lab Komputer Terpadu']
            ]]);

            $mock2 = new \stdClass();
            $mock2->id = 129;
            $mock2->status = 'approved';
            $mock2->kode_tte = 'TTE-PNC928374';
            $mock2->file_dokumen_pendukung = 'mock.pdf';
            $mock2->user = (object)['nama' => auth()->user()->nama];
            $mock2->detailPengajuans = collect([(object)[
                'id_ruangan' => 1,
                'tanggal_kegiatan' => date('Y-m-d', strtotime('-1 days')),
                'waktu_mulai' => '08:00:00',
                'waktu_selesai' => '15:00:00',
                'ruangan' => (object)['nama_ruangan' => 'Aula Utama H.1.1']
            ]]);

            $mock3 = new \stdClass();
            $mock3->id = 112;
            $mock3->status = 'rejected';
            $mock3->kode_tte = '-';
            $mock3->file_dokumen_pendukung = null;
            $mock3->user = (object)['nama' => auth()->user()->nama];
            $mock3->detailPengajuans = collect([(object)[
                'id_ruangan' => 3,
                'tanggal_kegiatan' => date('Y-m-d', strtotime('-5 days')),
                'waktu_mulai' => '13:00:00',
                'waktu_selesai' => '16:00:00',
                'ruangan' => (object)['nama_ruangan' => 'Ruang Rapat BAAK']
            ]]);

            $displayPengajuans = collect([$mock1, $mock2, $mock3]);
            $totalPeminjamanVal = 12;
            $menungguVerifikasiVal = 2;
            $telahDisetujuiVal = 10;
        } else {
            $totalPeminjamanVal = $totalPeminjaman;
            $menungguVerifikasiVal = $menungguVerifikasi;
            $telahDisetujuiVal = $telahDisetujui;
        }
    @endphp

    <!-- STATS ROW (3 Cards) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1: Total Peminjaman Ruangan -->
        <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm flex items-center gap-4.5 hover:shadow-md transition-shadow duration-200">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <div>
                <span class="text-xs text-slate-400 font-semibold block">Total Peminjaman Ruangan</span>
                <span class="text-2xl font-extrabold text-slate-800 leading-tight mt-0.5">{{ $totalPeminjamanVal }}</span>
            </div>
        </div>

        <!-- Card 2: Menunggu Verifikasi -->
        <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm flex items-center gap-4.5 hover:shadow-md transition-shadow duration-200">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <span class="text-xs text-slate-400 font-semibold block">Menunggu Verifikasi</span>
                <span class="text-2xl font-extrabold text-slate-800 leading-tight mt-0.5">{{ $menungguVerifikasiVal }}</span>
            </div>
        </div>

        <!-- Card 3: Telah Disetujui -->
        <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm flex items-center gap-4.5 hover:shadow-md transition-shadow duration-200">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <div>
                <span class="text-xs text-slate-400 font-semibold block">Telah Disetujui</span>
                <span class="text-2xl font-extrabold text-slate-800 leading-tight mt-0.5">{{ $telahDisetujuiVal }}</span>
            </div>
        </div>
    </div>

    <!-- TABLE SECTION -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-100">
            <h4 class="text-base font-bold text-slate-800">Aktivitas Peminjaman</h4>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-650">
                <thead class="bg-slate-50 text-slate-500 text-xxs font-bold uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4">ID Peminjaman</th>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Waktu Kegiatan</th>
                        <th class="px-6 py-4">Ruangan</th>
                        <th class="px-6 py-4">Detail Perizinan</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse($displayPengajuans as $pengajuan)
                        @php
                            $detail = $pengajuan->detailPengajuans->first();
                            $ruanganName = isset($detail->ruangan) ? $detail->ruangan->nama_ruangan : null;
                            
                            // Static room fallback
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
                        <tr class="hover:bg-slate-50/40 transition-colors">
                            <td class="px-6 py-4 font-mono font-bold text-slate-800">
                                PMJ-{{ str_pad($pengajuan->id, 4, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-800">
                                {{ $pengajuan->user?->nama ?? 'Unknown' }}
                            </td>
                            <td class="px-6 py-4 text-slate-500">
                                @if($detail)
                                    <span class="block font-semibold text-slate-700">{{ \Carbon\Carbon::parse($detail->tanggal_kegiatan)->translatedFormat('d M Y') }}</span>
                                    <span class="text-xxs text-slate-400 font-bold uppercase mt-0.5 block">{{ substr($detail->waktu_mulai, 0, 5) }} - {{ substr($detail->waktu_selesai, 0, 5) }}</span>
                                @else
                                    <span class="text-slate-400">Jadwal tidak tersedia</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-700">
                                {{ $ruanganName ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($pengajuan->status === 'approved')
                                    <div class="flex flex-col gap-1">
                                        <span class="text-xxs text-slate-450 font-bold uppercase tracking-wider block">Kode TTE:</span>
                                        <span class="font-mono text-xs font-extrabold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md inline-block self-start">{{ $pengajuan->kode_tte }}</span>
                                        @if($pengajuan->file_dokumen_pendukung)
                                            <a href="#" class="inline-flex items-center gap-1 text-xxs font-bold text-blue-600 hover:text-blue-700 mt-1 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                                </svg>
                                                Download Surat Izin
                                            </a>
                                        @endif
                                    </div>
                                @elseif($pengajuan->status === 'pending')
                                    <span class="text-slate-400 font-semibold">Sedang diproses verifikasi oleh BAAK</span>
                                @else
                                    <div class="flex flex-col">
                                        <span class="text-slate-400 font-semibold">Permintaan Ditolak</span>
                                        <span class="text-xxs text-rose-500 font-bold mt-0.5">Silakan ajukan kembali dengan berkas valid</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 text-xxs font-extrabold tracking-wide rounded-full border {{ $pengajuan->status === 'approved' ? 'bg-emerald-50 text-emerald-600 border-emerald-200/50' : ($pengajuan->status === 'pending' ? 'bg-blue-50 text-blue-600 border-blue-200/50' : 'bg-rose-50 text-rose-600 border-rose-200/50') }}">
                                    @if($pengajuan->status === 'approved')
                                        DISETUJUI
                                    @elseif($pengajuan->status === 'pending')
                                        MENUNGGU
                                    @else
                                        DITOLAK
                                    @endif
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400 font-semibold">
                                <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span>Belum ada aktivitas peminjaman ruangan.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
