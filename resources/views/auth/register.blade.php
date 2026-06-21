<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - SIPERUKA-PNC</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', 'Instrument Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 antialiased text-slate-800">
    <div class="grid grid-cols-1 lg:grid-cols-12 min-h-screen">

        <!-- LEFT COLUMN (Identical to login page for design consistency) -->
        <div
            class="lg:col-span-5 bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-900 text-white flex flex-col justify-between p-8 md:p-12 lg:p-16 relative overflow-hidden">
            <!-- Background Decorative circles -->
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-blue-500/20 rounded-full blur-2xl"></div>
            <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-indigo-500/20 rounded-full blur-3xl"></div>

            <!-- Logo -->
            <div class="mb-10 text-center relative z-10">
                <div
                    class="inline-flex items-center justify-center p-1 rounded-2xl bg-white shadow-xl shadow-blue-500/20 mb-4 ring-1 ring-slate-100">
                    <img src="{{ asset('images/logo.png') }}" alt="SIPERUKA Logo"
                        class="w-16 h-16 rounded-xl object-contain">
                </div>
                <div class="flex items-center justify-center gap-3">
                    <span class="text-lg font-extrabold tracking-tight">SIPERUKA-PNC</span>
                </div>
            </div>

            <!-- Content: Banner Title & Value Propositions -->
            <div class="my-auto py-12 relative z-10">
                <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight leading-tight max-w-sm">
                    Sistem Informasi Perizinan Ruangan
                </h2>
                <p class="mt-4 text-blue-100/90 text-sm md:text-base font-medium max-w-md">
                    Kelola dan ajukan perizinan penggunaan fasilitas ruangan kampus Politeknik Negeri Cilacap secara
                    instan.
                </p>

                <!-- Bullet Points -->
                <ul class="mt-10 space-y-4">
                    <li class="flex items-center gap-3.5 group">
                        <div
                            class="flex items-center justify-center w-6.5 h-6.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-blue-300 group-hover:bg-white/20 transition-all duration-200">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold tracking-wide text-blue-50">Pengajuan izin online tanpa tatap
                            muka</span>
                    </li>
                    <li class="flex items-center gap-3.5 group">
                        <div
                            class="flex items-center justify-center w-6.5 h-6.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-blue-300 group-hover:bg-white/20 transition-all duration-200">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold tracking-wide text-blue-50">Cek ketersediaan ruangan
                            real-time</span>
                    </li>
                    <li class="flex items-center gap-3.5 group">
                        <div
                            class="flex items-center justify-center w-6.5 h-6.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-blue-300 group-hover:bg-white/20 transition-all duration-200">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold tracking-wide text-blue-50">Verifikasi dengan Tanda Tangan
                            Elektronik</span>
                    </li>
                </ul>
            </div>

            <!-- Footer -->
            <div class="text-xs text-blue-200/60 relative z-10">
                &copy; 2026 SIPERUKA Kelompok 3 UAS PBO. Politeknik Negeri Cilacap.
            </div>
        </div>

        <!-- RIGHT COLUMN (Registration Form) -->
        <div class="lg:col-span-7 bg-white flex items-center justify-center p-8 md:p-12 lg:p-16">
            <div class="w-full max-w-md space-y-8">
                <!-- Heading -->
                <div>
                    <h3 class="text-2xl font-bold tracking-tight text-slate-900">Form Registrasi</h3>
                    <p class="text-sm text-slate-400 mt-1">Lengkapi informasi di bawah ini untuk membuat akun baru Anda.
                    </p>
                </div>

                <!-- Google OAuth Registration Button -->
                <a href="{{ route('auth.google') }}"
                    class="w-full py-3 px-4 flex items-center justify-center gap-3 bg-white border border-slate-200 hover:bg-slate-50 active:scale-[0.99] rounded-xl text-sm font-bold text-slate-700 shadow-sm shadow-slate-100 hover:shadow transition-all duration-200">
                    <!-- Google Logo SVG -->
                    <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                            fill="#4285F4" />
                        <path
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                            fill="#34A853" />
                        <path
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l3.66-2.85z"
                            fill="#FBBC05" />
                        <path
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.85c.87-2.6 3.3-4.53 6.16-4.53z"
                            fill="#EA4335" />
                    </svg>
                    Daftar dengan Google
                </a>

                <!-- Divider -->
                <div class="relative flex py-2 items-center">
                    <div class="flex-grow border-t border-slate-100"></div>
                    <span class="flex-shrink mx-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Atau
                        Daftar Manual</span>
                    <div class="flex-grow border-t border-slate-100"></div>
                </div>

                <!-- Manual Registration Form -->
                <form action="#" method="POST" class="space-y-4">
                    @csrf

                    <!-- Nama Lengkap Field -->
                    <div class="space-y-1.5">
                        <label for="nama" class="text-sm font-semibold text-slate-700">Nama Lengkap</label>
                        <div class="relative">
                            <input type="text" id="nama" name="nama" required
                                placeholder="Masukkan Nama Lengkap Anda..."
                                class="w-full pl-11 pr-4 py-2.5 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 placeholder-slate-400">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- NIM Field -->
                    <div class="space-y-1.5">
                        <label for="username" class="text-sm font-semibold text-slate-700">NIM</label>
                        <div class="relative">
                            <input type="text" id="username" name="username" required
                                placeholder="Masukkan NIM Anda (contoh: 230102045)..."
                                class="w-full pl-11 pr-4 py-2.5 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 placeholder-slate-400">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.333 0 4 .667 4 2v1H5v-1c0-1.333 2.667-2 2-2z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Alamat Email Field -->
                    <div class="space-y-1.5">
                        <label for="email" class="text-sm font-semibold text-slate-700">Alamat Email</label>
                        <div class="relative">
                            <input type="email" id="email" name="email" required
                                placeholder="Masukkan Alamat Email Anda..."
                                class="w-full pl-11 pr-4 py-2.5 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 placeholder-slate-400">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-1.5">
                        <label for="password" class="text-sm font-semibold text-slate-700">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required placeholder="••••••••"
                                class="w-full pl-11 pr-4 py-2.5 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 placeholder-slate-400">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="space-y-1.5">
                        <label for="password_confirmation" class="text-sm font-semibold text-slate-700">Konfirmasi
                            Password</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                placeholder="••••••••"
                                class="w-full pl-11 pr-4 py-2.5 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 placeholder-slate-400">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full py-3 px-4 bg-slate-900 hover:bg-slate-800 active:scale-[0.98] rounded-xl text-sm font-bold text-white shadow-md shadow-slate-900/10 hover:shadow-lg transition-all duration-200 mt-4 uppercase">
                        Daftar
                    </button>
                </form>

                <!-- Redirect to Login Link -->
                <p class="text-center text-xs text-slate-500 mt-4">
                    Sudah punya akun? <a href="/login"
                        class="font-bold text-blue-600 hover:text-blue-700 transition-colors">Login sekarang!</a>
                </p>
            </div>
        </div>

    </div>
</body>

</html>