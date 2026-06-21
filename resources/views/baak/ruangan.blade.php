@extends('layouts.app')

@section('title', 'Kelola Ruangan — BAAK')
@section('page_title', 'Kelola Ruangan')

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

    @if ($errors->any())
        <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl">
            <ul class="list-disc list-inside text-xs space-y-0.5">
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    {{-- ===== HEADER ===== --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-2xl font-extrabold tracking-tight text-slate-900">Kelola Ruangan</h3>
            <p class="text-xs text-slate-400 mt-1 font-semibold uppercase tracking-wider">Manajemen data ruangan kampus</p>
        </div>
        <button onclick="openAddModal()" class="inline-flex items-center gap-2 px-5 py-3 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-md shadow-blue-500/10 active:scale-[0.98] transition-all duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            Tambah Ruangan
        </button>
    </div>

    {{-- ===== ROOMS TABLE ===== --}}
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h4 class="text-base font-bold text-slate-800">Daftar Ruangan</h4>
            <span class="text-xs font-semibold text-slate-400">{{ $ruangans->count() }} ruangan</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-700 font-sans">
                <thead class="bg-slate-50 text-slate-500 text-xs font-bold uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Nama Ruangan</th>
                        <th class="px-6 py-4">Kapasitas</th>
                        <th class="px-6 py-4">Fasilitas</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse($ruangans as $ruangan)
                        <tr class="hover:bg-slate-50/40 transition-colors">
                            <td class="px-6 py-4 font-bold text-slate-800">{{ $ruangan->nama_ruangan }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $ruangan->kapasitas }} orang</td>
                            <td class="px-6 py-4 text-slate-500 max-w-xs truncate">{{ $ruangan->fasilitas ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @if($ruangan->status_ketersediaan)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-bold rounded-full bg-emerald-50 text-emerald-600 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Tersedia
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-bold rounded-full bg-rose-50 text-rose-600 border border-rose-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Tidak Tersedia
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button onclick='openEditModal(@json($ruangan))'
                                            class="px-3.5 py-2 text-xs font-bold text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-xl active:scale-[0.97] transition-all duration-150">
                                        Edit
                                    </button>
                                    <form action="{{ route('baak.ruangan.destroy', $ruangan->id) }}" method="POST"
                                          onsubmit="return confirm('Hapus ruangan {{ $ruangan->nama_ruangan }}? Aksi ini tidak dapat dibatalkan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3.5 py-2 text-xs font-bold text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-xl active:scale-[0.97] transition-all duration-150">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                <span class="text-sm font-semibold">Belum ada ruangan. Tambahkan ruangan pertama!</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- ===== ADD ROOM MODAL ===== --}}
<div id="add-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300">
    <div class="bg-white border border-slate-200 rounded-2xl max-w-lg w-full shadow-xl overflow-hidden transform scale-95 transition-transform duration-300">
        <div class="h-1.5 bg-gradient-to-r from-blue-600 to-indigo-600"></div>
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h4 class="text-base font-bold text-slate-800">Tambah Ruangan Baru</h4>
            <button onclick="closeAddModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form action="{{ route('baak.ruangan.store') }}" method="POST" class="p-5 space-y-4">
            @csrf
            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-slate-700">Nama Ruangan <span class="text-rose-500">*</span></label>
                <input type="text" name="nama_ruangan" required placeholder="Contoh: Lab Komputer A"
                       class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 text-slate-700">
            </div>
            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-slate-700">Kapasitas (orang) <span class="text-rose-500">*</span></label>
                <input type="number" name="kapasitas" required min="1" placeholder="Contoh: 40"
                       class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 text-slate-700">
            </div>
            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-slate-700">Fasilitas</label>
                <input type="text" name="fasilitas" placeholder="Contoh: AC, Proyektor, Whiteboard"
                       class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 text-slate-700">
            </div>
            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-slate-700">Status Ketersediaan <span class="text-rose-500">*</span></label>
                <select name="status_ketersediaan" required class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 text-slate-700">
                    <option value="1">Tersedia</option>
                    <option value="0">Tidak Tersedia</option>
                </select>
            </div>
            <div class="flex items-center justify-end gap-2.5 pt-2">
                <button type="button" onclick="closeAddModal()" class="px-4 py-2.5 text-xs font-bold text-slate-500 hover:bg-slate-100 rounded-xl transition-all duration-200">Batal</button>
                <button type="submit" class="px-5 py-2.5 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition-all duration-200 shadow-md shadow-blue-500/10 active:scale-[0.97]">Simpan Ruangan</button>
            </div>
        </form>
    </div>
</div>

{{-- ===== EDIT ROOM MODAL ===== --}}
<div id="edit-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300">
    <div class="bg-white border border-slate-200 rounded-2xl max-w-lg w-full shadow-xl overflow-hidden transform scale-95 transition-transform duration-300">
        <div class="h-1.5 bg-gradient-to-r from-amber-500 to-orange-500"></div>
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h4 class="text-base font-bold text-slate-800">Edit Ruangan</h4>
            <button onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form id="edit-form" action="" method="POST" class="p-5 space-y-4">
            @csrf
            @method('PUT')
            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-slate-700">Nama Ruangan <span class="text-rose-500">*</span></label>
                <input type="text" id="edit-nama" name="nama_ruangan" required
                       class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200 text-slate-700">
            </div>
            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-slate-700">Kapasitas (orang) <span class="text-rose-500">*</span></label>
                <input type="number" id="edit-kapasitas" name="kapasitas" required min="1"
                       class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200 text-slate-700">
            </div>
            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-slate-700">Fasilitas</label>
                <input type="text" id="edit-fasilitas" name="fasilitas"
                       class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200 text-slate-700">
            </div>
            <div class="space-y-1.5">
                <label class="text-xs font-semibold text-slate-700">Status Ketersediaan <span class="text-rose-500">*</span></label>
                <select id="edit-status" name="status_ketersediaan" required class="w-full px-3.5 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all duration-200 text-slate-700">
                    <option value="1">Tersedia</option>
                    <option value="0">Tidak Tersedia</option>
                </select>
            </div>
            <div class="flex items-center justify-end gap-2.5 pt-2">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2.5 text-xs font-bold text-slate-500 hover:bg-slate-100 rounded-xl transition-all duration-200">Batal</button>
                <button type="submit" class="px-5 py-2.5 text-xs font-bold text-white bg-amber-500 hover:bg-amber-600 rounded-xl transition-all duration-200 shadow-md shadow-amber-500/10 active:scale-[0.97]">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(id)   { const m = document.getElementById(id); m.classList.remove('hidden'); setTimeout(() => { m.classList.remove('opacity-0'); m.firstElementChild.classList.remove('scale-95'); }, 10); }
    function closeModal(id)  { const m = document.getElementById(id); m.classList.add('opacity-0'); m.firstElementChild.classList.add('scale-95'); setTimeout(() => m.classList.add('hidden'), 300); }

    function openAddModal()  { openModal('add-modal'); }
    function closeAddModal() { closeModal('add-modal'); }

    function openEditModal(ruangan) {
        document.getElementById('edit-form').action = `/baak/ruangan/${ruangan.id}`;
        document.getElementById('edit-nama').value      = ruangan.nama_ruangan;
        document.getElementById('edit-kapasitas').value = ruangan.kapasitas;
        document.getElementById('edit-fasilitas').value = ruangan.fasilitas ?? '';
        document.getElementById('edit-status').value    = ruangan.status_ketersediaan ? '1' : '0';
        openModal('edit-modal');
    }
    function closeEditModal() { closeModal('edit-modal'); }
</script>
@endsection
