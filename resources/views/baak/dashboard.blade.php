@extends('layouts.app')

@section('title', 'Dashboard BAAK')

@section('content')
<div class="space-y-8">

    {{-- ===== FLASH NOTIFICATIONS ===== --}}
    @if (session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-start gap-3 shadow-sm">
            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <h5 class="text-sm font-bold text-emerald-950">Berhasil!</h5>
                <p class="text-xs text-emerald-700 mt-0.5">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('info'))
        <div class="p-4 bg-amber-50 border border-amber-200 text-amber-800 rounded-2xl flex items-start gap-3 shadow-sm">
            <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <h5 class="text-sm font-bold text-amber-950">Pengajuan Ditolak</h5>
                <p class="text-xs text-amber-700 mt-0.5">{{ session('info') }}</p>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl">
            <ul class="list-disc list-inside text-xs space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ===== HEADER ===== --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-2xl font-extrabold tracking-tight text-slate-900">Selamat datang, BAAK!</h3>
            <p class="text-xs text-slate-400 mt-1 font-semibold font-sans uppercase tracking-wider">Sistem Informasi Perizinan Ruangan PNC</p>
        </div>
    </div>

    {{-- ===== STATS CARDS ===== --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Card: Menunggu Verifikasi --}}
        <div class="bg-white border border-amber-200 p-6 rounded-2xl shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow duration-200">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <span class="text-xs text-slate-400 font-semibold block">Menunggu Verifikasi</span>
                <span class="text-2xl font-extrabold text-slate-800 leading-tight mt-0.5">{{ $totalIncoming }}</span>
            </div>
        </div>

        {{-- Card: Telah Disetujui --}}
        <div class="bg-white border border-emerald-200 p-6 rounded-2xl shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow duration-200">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <span class="text-xs text-slate-400 font-semibold block">Telah Disetujui</span>
                <span class="text-2xl font-extrabold text-slate-800 leading-tight mt-0.5">{{ $totalVerified }}</span>
            </div>
        </div>

        {{-- Card: Ditolak --}}
        <div class="bg-white border border-rose-200 p-6 rounded-2xl shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow duration-200">
            <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <span class="text-xs text-slate-400 font-semibold block">Ditolak</span>
                <span class="text-2xl font-extrabold text-slate-800 leading-tight mt-0.5">{{ $totalRejected }}</span>
            </div>
        </div>
    </div>

    {{-- ===== SEARCH & FILTER PANEL ===== --}}
    <form action="{{ route('dashboard.baak') }}" method="GET" class="bg-white border border-slate-200 rounded-2xl shadow-sm p-4 flex flex-col md:flex-row gap-3 items-stretch md:items-center justify-between">
        {{-- Search Bar --}}
        <div class="relative flex-1 min-w-0 md:max-w-xs">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari nama mahasiswa atau NIM..."
                   class="w-full pl-10 pr-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 text-slate-700 placeholder-slate-400">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
        </div>

        {{-- Filters Row --}}
        <div class="flex flex-col sm:flex-row gap-3 items-stretch sm:items-center">
            {{-- Room Filter --}}
            <div class="relative min-w-[180px]">
                <select name="ruangan" class="w-full pl-4 pr-10 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 appearance-none text-slate-700">
                    <option value="">Semua Ruangan</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ request('ruangan') == $room->id ? 'selected' : '' }}>{{ $room->nama_ruangan }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3.5 text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>

            {{-- Status Filter --}}
            <div class="relative min-w-[160px]">
                <select name="status" class="w-full pl-4 pr-10 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 appearance-none text-slate-700">
                    <option value="">Semua Status</option>
                    <option value="pending"  {{ request('status') === 'pending'   ? 'selected' : '' }}>Menunggu</option>
                    <option value="approved" {{ request('status') === 'approved'  ? 'selected' : '' }}>Disetujui</option>
                    <option value="rejected" {{ request('status') === 'rejected'  ? 'selected' : '' }}>Ditolak</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3.5 text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>

            {{-- Filter Submit --}}
            <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition-all duration-200 flex items-center justify-center gap-2 shadow-sm shadow-blue-500/10 active:scale-[0.98]">
                Filter
            </button>

            @if(request()->hasAny(['search', 'ruangan', 'status']))
                <a href="{{ route('dashboard.baak') }}" class="px-4 py-2.5 text-sm font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-all duration-200 flex items-center justify-center">
                    Reset
                </a>
            @endif
        </div>
    </form>

    {{-- ===== PENGAJUAN TABLE ===== --}}
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h4 class="text-base font-bold text-slate-800">Antrean Verifikasi Pengajuan</h4>
            <span class="text-xs font-semibold text-slate-400">{{ $pengajuans->count() }} pengajuan</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-700 font-sans">
                <thead class="bg-slate-50 text-slate-500 text-xs font-bold uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Nama Mahasiswa</th>
                        <th class="px-6 py-4">Waktu Kegiatan</th>
                        <th class="px-6 py-4">Ruangan</th>
                        <th class="px-6 py-4">Dokumen</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse($pengajuans as $pengajuan)
                        @php
                            $detail      = $pengajuan->detailPengajuans->first();
                            $ruanganName = $detail?->ruangan?->nama_ruangan ?? ($detail ? 'Ruangan #' . $detail->id_ruangan : 'N/A');
                        @endphp
                        <tr class="hover:bg-slate-50/40 transition-colors">
                            <td class="px-6 py-4 font-mono font-bold text-slate-800">
                                PMJ-{{ str_pad($pengajuan->id, 4, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-slate-800 block">{{ $pengajuan->user?->nama ?? 'Unknown' }}</span>
                                <span class="text-slate-400 font-semibold mt-0.5">{{ $pengajuan->user?->username ?? 'N/A' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($detail)
                                    <span class="block font-semibold text-slate-700">{{ \Carbon\Carbon::parse($detail->tanggal_kegiatan)->translatedFormat('d M Y') }}</span>
                                    <span class="text-slate-400 font-bold uppercase mt-0.5 block">{{ substr($detail->waktu_mulai, 0, 5) }} - {{ substr($detail->waktu_selesai, 0, 5) }}</span>
                                @else
                                    <span class="text-slate-400 font-medium">Jadwal tidak tersedia</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-700">{{ $ruanganName }}</td>
                            <td class="px-6 py-4">
                                @if($pengajuan->file_dokumen_pendukung)
                                    <a href="{{ route('baak.pengajuan.dokumen', $pengajuan->id) }}"
                                       target="_blank"
                                       class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-600 hover:text-blue-700 transition-colors">
                                        <svg class="w-4 h-4 shrink-0 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        Lihat PDF
                                    </a>
                                @else
                                    <span class="text-xs text-slate-400">Tidak ada berkas</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    {{-- Detail Button --}}
                                    @if(is_numeric($pengajuan->id))
                                        <button onclick="openDetailModal({{ $pengajuan->id }})"
                                                class="inline-flex items-center px-3 py-2 text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl active:scale-[0.97] transition-all duration-150">
                                            Detail
                                        </button>
                                    @endif

                                    @if($pengajuan->status === 'pending')
                                        {{-- Approve --}}
                                        <form action="{{ route('baak.pengajuan.approve', $pengajuan->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-3.5 py-2 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-sm shadow-blue-500/10 active:scale-[0.97] transition-all duration-150">
                                                Terima &amp; TTE
                                            </button>
                                        </form>
                                        {{-- Reject Trigger --}}
                                        <button onclick="openRejectionModal('{{ route('baak.pengajuan.reject', $pengajuan->id) }}')"
                                                class="inline-flex items-center px-3.5 py-2 text-xs font-bold text-slate-700 bg-slate-100 hover:bg-rose-50 hover:text-rose-600 rounded-xl active:scale-[0.97] transition-all duration-150">
                                            Tolak
                                        </button>
                                    @else
                                        @if($pengajuan->status === 'approved')
                                            <a href="{{ route('baak.pengajuan.surat-izin', $pengajuan->id) }}" target="_blank"
                                               class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-bold text-emerald-700 bg-emerald-100 hover:bg-emerald-200 rounded-xl active:scale-[0.97] transition-all duration-150">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                Lihat Surat Izin
                                            </a>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-extrabold tracking-wide rounded-full border bg-rose-50 text-rose-600 border-rose-200/50">
                                                DITOLAK
                                            </span>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <span class="text-sm font-semibold">Tidak ada permohonan peminjaman ditemukan.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- ===== REJECTION REASON MODAL ===== --}}
<div id="rejection-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300">
    <div class="bg-white border border-slate-200 rounded-2xl max-w-md w-full shadow-xl overflow-hidden transform scale-95 transition-transform duration-300">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h4 class="text-base font-bold text-slate-800">Alasan Penolakan</h4>
            <button onclick="closeRejectionModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form id="rejection-form" action="" method="POST" class="p-5 space-y-4">
            @csrf
            <div class="space-y-1.5">
                <label for="alasan_input" class="text-xs font-semibold text-slate-700">Catatan / Alasan Penolakan <span class="text-rose-500">*</span></label>
                <textarea id="alasan_input" name="alasan" required rows="3"
                          placeholder="Masukkan alasan penolakan pengajuan peminjaman..."
                          class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-rose-500/15 focus:border-rose-500 transition-all duration-200 placeholder-slate-400 text-slate-700"></textarea>
            </div>
            <div class="flex items-center justify-end gap-2.5 pt-2">
                <button type="button" onclick="closeRejectionModal()" class="px-4 py-2.5 text-xs font-bold text-slate-500 hover:bg-slate-100 rounded-xl transition-all duration-200">Batal</button>
                <button type="submit" class="px-4 py-2.5 text-xs font-bold text-white bg-rose-600 hover:bg-rose-700 rounded-xl transition-all duration-200 shadow-md shadow-rose-500/10 active:scale-[0.97]">Kirim Penolakan</button>
            </div>
        </form>
    </div>
</div>

{{-- ===== DETAIL PENGAJUAN MODAL ===== --}}
<div id="detail-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300">
    <div class="bg-white border border-slate-200 rounded-2xl max-w-lg w-full shadow-xl overflow-hidden transform scale-95 transition-transform duration-300">
        <div class="h-1.5 bg-gradient-to-r from-blue-600 to-indigo-600"></div>
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h4 class="text-base font-bold text-slate-800">Detail Pengajuan</h4>
            <button onclick="closeDetailModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div id="detail-modal-body" class="p-5 space-y-4">
            <div class="flex items-center justify-center py-8 text-slate-400">
                <svg class="animate-spin w-8 h-8 text-blue-500" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
            </div>
        </div>
    </div>
</div>

<script>
    // ============== REJECTION MODAL ==============
    function openRejectionModal(actionUrl) {
        const modal = document.getElementById('rejection-modal');
        document.getElementById('rejection-form').action = actionUrl;
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modal.firstElementChild.classList.remove('scale-95');
        }, 10);
    }
    function closeRejectionModal() {
        const modal = document.getElementById('rejection-modal');
        modal.classList.add('opacity-0');
        modal.firstElementChild.classList.add('scale-95');
        setTimeout(() => modal.classList.add('hidden'), 300);
    }

    // ============== DETAIL MODAL ==============
    function openDetailModal(id) {
        const modal    = document.getElementById('detail-modal');
        const body     = document.getElementById('detail-modal-body');
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        const csrf     = csrfMeta ? csrfMeta.getAttribute('content') : '';

        // Show loading state
        body.innerHTML = '<div class="flex items-center justify-center py-8 text-slate-400"><svg class="animate-spin w-8 h-8 text-blue-500" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg></div>';

        // Show modal
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modal.firstElementChild.classList.remove('scale-95');
        }, 10);

        // Fetch detail
        fetch(`/baak/pengajuan/${id}`, {
            headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
            const statusColors = {
                pending:  'bg-amber-50 text-amber-600 border-amber-200',
                approved: 'bg-emerald-50 text-emerald-600 border-emerald-200',
                rejected: 'bg-rose-50 text-rose-600 border-rose-200',
            };
            const statusLabels = { pending: 'MENUNGGU', approved: 'DISETUJUI', rejected: 'DITOLAK' };
            const statusColor  = statusColors[data.status] || 'bg-slate-50 text-slate-600 border-slate-200';
            const statusLabel  = statusLabels[data.status] || data.status.toUpperCase();

            body.innerHTML = `
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-lg font-extrabold text-slate-800">PMJ-${String(data.id).padStart(4,'0')}</span>
                        <span class="inline-flex items-center px-3 py-1 text-xs font-extrabold tracking-wide rounded-full border ${statusColor}">${statusLabel}</span>
                    </div>

                    <div class="bg-slate-50 rounded-xl p-4 space-y-3 text-sm border border-slate-100">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400 pb-1 border-b border-slate-200">Data Pemohon</p>
                        <div class="flex justify-between"><span class="text-slate-500">Nama</span><span class="font-bold text-slate-800">${data.pemohon.nama}</span></div>
                        <div class="flex justify-between"><span class="text-slate-500">NIM / Username</span><span class="font-bold text-slate-800">${data.pemohon.username}</span></div>
                        <div class="flex justify-between"><span class="text-slate-500">Email</span><span class="font-bold text-slate-800">${data.pemohon.email}</span></div>
                    </div>

                    ${data.detail ? `
                    <div class="bg-slate-50 rounded-xl p-4 space-y-3 text-sm border border-slate-100">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400 pb-1 border-b border-slate-200">Detail Peminjaman</p>
                        <div class="flex justify-between"><span class="text-slate-500">Ruangan</span><span class="font-bold text-slate-800">${data.detail.ruangan}</span></div>
                        <div class="flex justify-between"><span class="text-slate-500">Tanggal</span><span class="font-bold text-slate-800">${data.detail.tanggal_kegiatan}</span></div>
                        <div class="flex justify-between"><span class="text-slate-500">Waktu</span><span class="font-bold text-slate-800">${data.detail.waktu_mulai} - ${data.detail.waktu_selesai}</span></div>
                    </div>` : ''}

                    ${data.kode_tte && data.kode_tte !== '-' ? `
                    <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4">
                        <p class="text-xs font-bold text-emerald-600 uppercase tracking-wider mb-1">Kode TTE</p>
                        <p class="font-mono font-extrabold text-emerald-800 text-base">${data.kode_tte}</p>
                    </div>` : ''}

                    ${data.file_dokumen ? `
                    <a href="${data.file_dokumen}" target="_blank"
                       class="flex items-center gap-2 w-full py-3 px-4 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition-all duration-200 justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Buka Dokumen PDF
                    </a>` : '<p class="text-center text-xs text-slate-400 py-2">Tidak ada dokumen pendukung.</p>'}
                </div>
            `;
        })
        .catch(() => {
            body.innerHTML = '<p class="text-center text-sm text-rose-500 py-8">Gagal memuat detail. Coba lagi.</p>';
        });
    }

    function closeDetailModal() {
        const modal = document.getElementById('detail-modal');
        modal.classList.add('opacity-0');
        modal.firstElementChild.classList.add('scale-95');
        setTimeout(() => modal.classList.add('hidden'), 300);
    }
</script>
@endsection
