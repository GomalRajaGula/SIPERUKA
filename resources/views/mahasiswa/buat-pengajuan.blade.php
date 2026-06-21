@extends('layouts.app')

@section('title', 'Buat Pengajuan Peminjaman')
@section('page_title', 'Buat Pengajuan Baru')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- BREADCRUMB / GO BACK LINK -->
    <div class="flex items-center gap-2 text-sm">
        <a href="{{ route('dashboard.mahasiswa') }}" class="text-slate-400 hover:text-blue-600 transition-colors">Dashboard</a>
        <svg class="w-4 h-4 text-slate-350" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <span class="text-slate-650 font-semibold">Buat Pengajuan</span>
    </div>

    <!-- ERROR ALERTS -->
    @if ($errors->any())
        <div class="p-4.5 bg-rose-50/80 border border-rose-250 text-rose-800 rounded-2xl flex items-start gap-3.5 shadow-sm shadow-rose-100/10">
            <div class="w-9 h-9 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <div>
                <h5 class="text-sm font-bold text-rose-900">Pengisian Formulir Gagal</h5>
                <p class="text-xs text-rose-700/90 mt-0.5">Silakan periksa kembali beberapa inputan berikut:</p>
                <ul class="list-disc list-inside text-xs text-rose-750 mt-2 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- FORM CARD -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <!-- Visual Accent Line -->
        <div class="h-1.5 bg-gradient-to-r from-blue-600 to-indigo-650"></div>

        <form action="{{ route('mahasiswa.buat-pengajuan.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 space-y-6">
            @csrf

            <!-- Section 1: Detail Ruangan & Waktu -->
            <div class="space-y-4">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-50 text-blue-600 font-bold text-xs">1</span>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-500">Ruangan & Jadwal</h4>
                </div>

                <!-- Dropdown Pilih Ruangan -->
                <div class="space-y-1.5">
                    <label for="id_ruangan" class="text-sm font-semibold text-slate-700">Pilih Ruangan <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <select id="id_ruangan" name="id_ruangan" required
                            class="w-full px-4 py-3 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/25 focus:border-blue-500 transition-all duration-200 appearance-none text-slate-700">
                            <option value="" disabled selected>Pilih ruangan yang ingin diajukan...</option>
                            @if($rooms->isEmpty())
                                <option value="1" {{ old('id_ruangan') == 1 ? 'selected' : '' }}>Aula Utama H.1.1 (Kapasitas: 150)</option>
                                <option value="2" {{ old('id_ruangan') == 2 ? 'selected' : '' }}>Lab Komputer Terpadu (Kapasitas: 40)</option>
                                <option value="3" {{ old('id_ruangan') == 3 ? 'selected' : '' }}>Ruang Rapat BAAK (Kapasitas: 20)</option>
                                <option value="4" {{ old('id_ruangan') == 4 ? 'selected' : '' }}>Gedung Serba Guna (GSG) (Kapasitas: 300)</option>
                            @else
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ old('id_ruangan') == $room->id ? 'selected' : '' }}>{{ $room->nama_ruangan }} (Kapasitas: {{ $room->kapasitas }})</option>
                                @endforeach
                            @endif
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Tanggal & Waktu Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Tanggal Peminjaman -->
                    <div class="space-y-1.5">
                        <label for="tanggal_kegiatan" class="text-sm font-semibold text-slate-700">Tanggal Peminjaman <span class="text-rose-500">*</span></label>
                        <input type="date" id="tanggal_kegiatan" name="tanggal_kegiatan" required
                            value="{{ old('tanggal_kegiatan') }}"
                            class="w-full px-4 py-3 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/25 focus:border-blue-500 transition-all duration-200 text-slate-700">
                    </div>

                    <!-- Waktu Mulai -->
                    <div class="space-y-1.5">
                        <label for="waktu_mulai" class="text-sm font-semibold text-slate-700">Waktu Mulai <span class="text-rose-500">*</span></label>
                        <input type="time" id="waktu_mulai" name="waktu_mulai" required
                            value="{{ old('waktu_mulai') }}"
                            class="w-full px-4 py-3 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/25 focus:border-blue-500 transition-all duration-200 text-slate-700">
                    </div>

                    <!-- Waktu Selesai -->
                    <div class="space-y-1.5">
                        <label for="waktu_selesai" class="text-sm font-semibold text-slate-700">Waktu Selesai <span class="text-rose-500">*</span></label>
                        <input type="time" id="waktu_selesai" name="waktu_selesai" required
                            value="{{ old('waktu_selesai') }}"
                            class="w-full px-4 py-3 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/25 focus:border-blue-500 transition-all duration-200 text-slate-700">
                    </div>
                </div>
            </div>

            <!-- Section 2: Keperluan & Agenda -->
            <div class="space-y-4 pt-2">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-50 text-blue-600 font-bold text-xs">2</span>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-500">Keperluan & Agenda</h4>
                </div>

                <!-- Keperluan / Agenda Kegiatan -->
                <div class="space-y-1.5">
                    <label for="keperluan" class="text-sm font-semibold text-slate-700">Keperluan / Agenda Kegiatan <span class="text-rose-500">*</span></label>
                    <textarea id="keperluan" name="keperluan" rows="4" required
                        placeholder="Jelaskan secara detail mengenai keperluan peminjaman ruangan dan agenda acara..."
                        class="w-full px-4 py-3 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/25 focus:border-blue-500 transition-all duration-200 placeholder-slate-400 text-slate-700">{{ old('keperluan') }}</textarea>
                </div>
            </div>

            <!-- Section 3: Dokumen Pendukung -->
            <div class="space-y-4 pt-2">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-50 text-blue-600 font-bold text-xs">3</span>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-500">Berkas Lampiran</h4>
                </div>

                <!-- Dokumen Pendukung / Surat Pengantar -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700">Dokumen Pendukung / Surat Pengantar <span class="text-rose-500">*</span></label>
                    
                    <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-slate-200 rounded-xl bg-slate-50/40 hover:bg-slate-50/70 transition-all duration-200 group">
                        <div class="space-y-2 text-center">
                            <svg class="mx-auto h-12 w-12 text-slate-400 group-hover:text-blue-500 transition-colors duration-200" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-slate-650 justify-center">
                                <label for="file_dokumen_pendukung" class="relative cursor-pointer bg-transparent rounded-md font-bold text-blue-600 hover:text-blue-700 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                    <span>Pilih berkas PDF</span>
                                    <input id="file_dokumen_pendukung" name="file_dokumen_pendukung" type="file" accept=".pdf" required class="sr-only">
                                </label>
                                <p class="pl-1">atau seret ke sini</p>
                            </div>
                            <p class="text-xxs text-slate-400">PDF hingga 5MB</p>
                            <!-- Selected file name output -->
                            <div id="file-name-container" class="hidden flex items-center justify-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-250 px-3 py-1.5 rounded-lg mt-2 inline-flex mx-auto">
                                <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span id="file-name-display" class="text-xs font-bold truncate max-w-[250px]"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('dashboard.mahasiswa') }}" class="px-5 py-3 text-sm font-semibold text-slate-500 hover:bg-slate-100 hover:text-slate-700 rounded-xl transition-all duration-200">
                    Batalkan
                </a>
                <button type="submit" class="px-6 py-3 text-sm font-semibold text-white bg-blue-900 hover:bg-blue-800 rounded-xl shadow-md shadow-blue-900/10 active:scale-[0.98] transition-all duration-200">
                    Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>

</div>

<!-- Script to handle file name display -->
<script>
    const fileInput = document.getElementById('file_dokumen_pendukung');
    const nameContainer = document.getElementById('file-name-container');
    const nameDisplay = document.getElementById('file-name-display');

    fileInput.addEventListener('change', (e) => {
        if(fileInput.files.length > 0) {
            nameDisplay.textContent = fileInput.files[0].name;
            nameContainer.classList.remove('hidden');
        } else {
            nameContainer.classList.add('hidden');
        }
    });
</script>
@endsection
