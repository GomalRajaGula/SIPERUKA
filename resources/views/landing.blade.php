<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPERUKA PNC - Sistem Informasi Perizinan Ruangan Kampus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }
        
        .hero-bg {
            background-color: #0052cc;
            background-image: linear-gradient(135deg, #0052cc 0%, #0077ff 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.5;
        }
    </style>
</head>
<body class="bg-white antialiased text-slate-800">

    <!-- Navbar -->
    <nav class="bg-white border-b border-slate-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="SIPERUKA Logo" class="h-20 w-auto" onerror="this.outerHTML='<div class=\'w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white font-black text-2xl\'>S</div>'">
                    <span class="font-extrabold text-xl tracking-tight text-slate-900 uppercase">Siperuka PNC</span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-semibold text-slate-700 hover:text-blue-600 border-2 border-slate-200 rounded-lg hover:border-blue-600 transition-all">Login</a>
                    <a href="{{ route('register') }}" class="px-5 py-2.5 text-sm font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-all">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section Banner -->
    <section class="w-full">
        <!-- We use a full width image here as shown in the screenshot -->
        <div class="w-full relative overflow-hidden flex items-center justify-center min-h-[100px] md:min-h-[150px]">
            <img src="{{ asset('images/land.jpeg') }}" alt="Selamat Datang di SIPERUKA-PNC" class="w-full h-auto object-cover" onerror="this.style.display='none'; document.getElementById('fallback-hero').style.display='block';">
            
            <!-- Fallback if image is not available -->
            <div id="fallback-hero" class="absolute inset-0 bg-gradient-to-r from-blue-700 to-blue-500 hidden flex-col items-center justify-center text-center px-4">
                <p class="text-white/80 font-bold tracking-widest text-sm md:text-base uppercase mb-2">Selamat Datang Di</p>
                <h1 class="text-4xl md:text-7xl font-black text-white tracking-tight drop-shadow-lg mb-4">SIPERUKA-PNC</h1>
                <p class="text-white/90 text-xs md:text-sm max-w-xl mx-auto drop-shadow">Sistem Informasi Perizinan Ruangan Kampus Terintegrasi Politeknik Negeri Cilacap.</p>
            </div>
        </div>
    </section>

    <!-- Intro Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-12">
            <div class="md:w-3/5 space-y-6">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-black leading-tight tracking-tight">
                    Sistem Informasi<br>Perizinan Ruangan<br>Kampus Terintegrasi
                </h2>
                <p class="text-slate-500 leading-relaxed text-base md:text-lg max-w-lg">
                    Platform digital untuk pengajuan, persetujuan, dan pengelolaan jadwal penggunaan fasilitas kampus secara real-time.
                </p>
                <div class="pt-4">
                    <a href="{{ route('register') }}" class="inline-block px-6 py-3 text-sm font-bold text-white bg-blue-700 rounded-lg hover:bg-blue-800 shadow-md transition-all">
                        Mulai Ajukan Izin
                    </a>
                </div>
            </div>
            <div class="md:w-2/5 flex justify-center md:justify-end">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Besar SIPERUKA" class="w-70 md:w-80 h-auto object-contain" onerror="this.outerHTML='<div class=\'text-blue-700 font-black text-[150px] leading-none\'>S</div>'">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-blue-50/50 border-y border-blue-100/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-extrabold text-slate-900 mb-4">Fitur Utama SIPERUKA</h2>
            <p class="text-slate-500 max-w-3xl mx-auto mb-16 leading-relaxed">
                SIPERUKA-PNC hadir sebagai solusi digital terpusat untuk mempermudah seluruh siklus perizinan ruangan di lingkungan Politeknik Negeri Cilacap. Melalui platform ini, Organisasi Mahasiswa (Ormawa) dan unit kerja kampus dapat memantau ketersediaan ruangan secara real-time, mengajukan izin tanpa prosedur fisik, serta mencegah risiko tumpang tindih jadwal (double booking).
            </p>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-left">
                    <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-blue-600/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">E-Permit Digital</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Pengajuan tanpa kertas, praktis, dan ramah lingkungan. Semua proses dilakukan secara digital.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-left">
                    <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-blue-600/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Kalender Real-time</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Mencegah tumpang tindih jadwal dengan sistem pemantauan ketersediaan ruangan secara langsung.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-left">
                    <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-blue-600/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Verifikasi TTE</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Pengesahan menggunakan Tanda Tangan Elektronik untuk keamanan dan validitas dokumen.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Workflow Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-extrabold text-slate-900 mb-16">Bagaimana Alur Pengajuannya?</h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
                <!-- Connecting Line (Desktop only) -->
                <div class="hidden md:block absolute top-12 left-[12.5%] right-[12.5%] h-0.5 bg-slate-200 -z-10"></div>

                <!-- Step 1 -->
                <div class="bg-slate-50/80 border border-slate-100 p-8 rounded-3xl relative pt-12">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md ring-4 ring-white">1</div>
                    <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg shadow-blue-600/20">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    </div>
                    <h4 class="font-bold text-slate-900 mb-2">Registrasi & Login</h4>
                    <p class="text-xs text-slate-500">Buat akun mahasiswa Anda untuk mengakses sistem.</p>
                </div>

                <!-- Step 2 -->
                <div class="bg-slate-50/80 border border-slate-100 p-8 rounded-3xl relative pt-12">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md ring-4 ring-white">2</div>
                    <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg shadow-blue-600/20">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                    <h4 class="font-bold text-slate-900 mb-2">Cek Jadwal & Isi Form</h4>
                    <p class="text-xs text-slate-500">Pastikan ruangan kosong dan unggah dokumen pendukung.</p>
                </div>

                <!-- Step 3 -->
                <div class="bg-slate-50/80 border border-slate-100 p-8 rounded-3xl relative pt-12">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md ring-4 ring-white">3</div>
                    <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg shadow-blue-600/20">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="font-bold text-slate-900 mb-2">Verifikasi BAAK</h4>
                    <p class="text-xs text-slate-500">Proses peninjauan oleh admin akademik.</p>
                </div>

                <!-- Step 4 -->
                <div class="bg-slate-50/80 border border-slate-100 p-8 rounded-3xl relative pt-12">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md ring-4 ring-white">4</div>
                    <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg shadow-blue-600/20">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h4 class="font-bold text-slate-900 mb-2">Izin Terbit</h4>
                    <p class="text-xs text-slate-500">Status approved dan TTE otomatis terbit.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-20 bg-blue-50/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-extrabold text-slate-900 mb-2">Hubungi Kami</h2>
            <p class="text-slate-500 mb-12">Siap membantu Anda!</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
                <!-- Phone -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col items-center justify-center hover:border-blue-200 transition-colors">
                    <svg class="w-8 h-8 text-slate-800 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    <h4 class="font-bold text-slate-900">Telephone</h4>
                    <p class="text-slate-500 text-sm mt-1">+62 812-3456-7890</p>
                </div>

                <!-- Email -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col items-center justify-center hover:border-blue-200 transition-colors">
                    <svg class="w-8 h-8 text-slate-800 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <h4 class="font-bold text-slate-900">Gmail</h4>
                    <p class="text-slate-500 text-sm mt-1">pnc.stu@ac.id</p>
                </div>

                <!-- Address -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col items-center justify-center hover:border-blue-200 transition-colors">
                    <svg class="w-8 h-8 text-slate-800 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <h4 class="font-bold text-slate-900">Alamat</h4>
                    <p class="text-slate-500 text-sm mt-1">Jl. Sidakaya, Cilacap</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 py-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="flex justify-center space-x-2 mb-4">
                <div class="w-2 h-2 bg-slate-600 rounded-full"></div>
                <div class="w-2 h-2 bg-slate-600 rounded-full"></div>
                <div class="w-2 h-2 bg-slate-600 rounded-full"></div>
            </div>
            <p class="text-slate-400 text-xs">
                &copy; {{ date('Y') }} Politeknik Negeri Cilacap - Sistem Informasi Perizinan Ruangan
            </p>
        </div>
    </footer>

</body>
</html>
