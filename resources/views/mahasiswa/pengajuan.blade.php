@extends('layouts.mahasiswa')

@section('title', 'Pengajuan Ruangan')

@section('content')
<div class="mb-8">
    <nav class="flex mb-2" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 text-xs font-medium text-slate-500">
            <li class="inline-flex items-center">
                <a href="#" class="hover:text-blue-600 transition-colors">Portal Pemohon</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3.5 h-3.5 text-slate-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-slate-700">Pengajuan Ruangan</span>
                </div>
            </li>
        </ol>
    </nav>
    <h3 class="text-2xl font-bold tracking-tight text-slate-900 md:text-3xl">Formulir Pengajuan Ruangan</h3>
    <p class="mt-1.5 text-sm text-slate-500">Ajukan izin peminjaman ruangan untuk kegiatan kemahasiswaan atau akademis resmi.</p>
</div>

<!-- Form Card -->
<div class="overflow-hidden bg-white border border-slate-200/80 rounded-2xl shadow-sm shadow-slate-100/50">
    <!-- Visual Blue Accent Top Line -->
    <div class="h-1.5 bg-gradient-to-r from-blue-500 via-blue-600 to-indigo-650"></div>
    
    <form action="#" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 space-y-6">
        @csrf

        <!-- Group 1: Informasi Kegiatan -->
        <div class="space-y-4">
            <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-50 text-blue-600 font-bold text-xs">1</span>
                <h4 class="text-sm font-bold uppercase tracking-wider text-slate-500">Informasi Kegiatan</h4>
            </div>

            <!-- Nama Kegiatan -->
            <div class="space-y-1.5">
                <label for="nama_kegiatan" class="text-sm font-semibold text-slate-700">Nama Kegiatan <span class="text-rose-500">*</span></label>
                <input type="text" id="nama_kegiatan" name="nama_kegiatan" required 
                    placeholder="Masukkan nama atau judul kegiatan..." 
                    class="w-full px-4 py-3 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 placeholder-slate-400">
            </div>

            <!-- Pilih Ruangan -->
            <div class="space-y-1.5">
                <label for="id_ruangan" class="text-sm font-semibold text-slate-700">Pilih Ruangan <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <select id="id_ruangan" name="id_ruangan" required
                        class="w-full px-4 py-3 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 appearance-none text-slate-700">
                        <option value="" disabled selected>Pilih ruangan yang ingin diajukan...</option>
                        <option value="1">Aula Utama H.1.1 (Kapasitas: 150)</option>
                        <option value="2">Lab Komputer Terpadu (Kapasitas: 40)</option>
                        <option value="3">Ruang Rapat BAAK (Kapasitas: 20)</option>
                        <option value="4">Gedung Serba Guna (GSG) (Kapasitas: 300)</option>
                    </select>
                    <!-- Custom dropdown arrow -->
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Group 2: Detail Waktu & Jadwal -->
        <div class="space-y-4 pt-2">
            <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-50 text-blue-600 font-bold text-xs">2</span>
                <h4 class="text-sm font-bold uppercase tracking-wider text-slate-500">Jadwal Penggunaan</h4>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Tanggal Kegiatan -->
                <div class="space-y-1.5">
                    <label for="tanggal_kegiatan" class="text-sm font-semibold text-slate-700">Tanggal Kegiatan <span class="text-rose-500">*</span></label>
                    <input type="date" id="tanggal_kegiatan" name="tanggal_kegiatan" required
                        class="w-full px-4 py-3 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 text-slate-700">
                </div>

                <!-- Waktu Mulai -->
                <div class="space-y-1.5">
                    <label for="waktu_mulai" class="text-sm font-semibold text-slate-700">Waktu Mulai <span class="text-rose-500">*</span></label>
                    <input type="time" id="waktu_mulai" name="waktu_mulai" required
                        class="w-full px-4 py-3 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 text-slate-700">
                </div>

                <!-- Waktu Selesai -->
                <div class="space-y-1.5">
                    <label for="waktu_selesai" class="text-sm font-semibold text-slate-700">Waktu Selesai <span class="text-rose-500">*</span></label>
                    <input type="time" id="waktu_selesai" name="waktu_selesai" required
                        class="w-full px-4 py-3 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 text-slate-700">
                </div>
            </div>
        </div>

        <!-- Group 3: Lampiran Dokumen -->
        <div class="space-y-4 pt-2">
            <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-50 text-blue-600 font-bold text-xs">3</span>
                <h4 class="text-sm font-bold uppercase tracking-wider text-slate-500">Berkas Pendukung</h4>
            </div>

            <!-- Surat Pendukung File Upload -->
            <div class="space-y-2">
                <label class="text-sm font-semibold text-slate-700">Upload Surat Pendukung (Proposal/Surat Izin) <span class="text-rose-500">*</span></label>
                
                <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-slate-200 rounded-xl bg-slate-50/30 hover:bg-slate-50/70 transition-all duration-200 group">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-slate-400 group-hover:text-blue-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-slate-600">
                            <label for="file_dokumen_pendukung" class="relative cursor-pointer bg-transparent rounded-md font-semibold text-blue-600 hover:text-blue-700 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>Pilih berkas</span>
                                <input id="file_dokumen_pendukung" name="file_dokumen_pendukung" type="file" required class="sr-only">
                            </label>
                            <p class="pl-1">atau seret dan taruh berkas di sini</p>
                        </div>
                        <p class="text-xs text-slate-400">PDF, DOC, DOCX, atau Gambar hingga 5MB</p>
                        <!-- Dynamic file label display -->
                        <p id="file-name-display" class="hidden text-sm font-semibold text-emerald-600 mt-2"></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
            <a href="#" class="px-5 py-3 text-sm font-semibold text-slate-500 hover:bg-slate-100 hover:text-slate-700 rounded-xl transition-all duration-200">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 text-sm font-semibold text-white bg-blue-650 hover:bg-blue-700 rounded-xl shadow-md shadow-blue-500/10 hover:shadow-blue-500/20 active:scale-[0.98] transition-all duration-200">
                Kirim Pengajuan
            </button>
        </div>

    </form>
</div>

<!-- File upload feedback script -->
<script>
    const fileInput = document.getElementById('file_dokumen_pendukung');
    const fileNameDisplay = document.getElementById('file-name-display');

    fileInput.addEventListener('change', (e) => {
        if(fileInput.files.length > 0) {
            fileNameDisplay.textContent = 'Berkas dipilih: ' + fileInput.files[0].name;
            fileNameDisplay.classList.remove('hidden');
        } else {
            fileNameDisplay.classList.add('hidden');
        }
    });
</script>
@endsection
