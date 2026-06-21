<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SIPERUKA</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', 'Instrument Sans', sans-serif;
            background-color: #f8fafc;
        }
    </style>
</head>
<body class="overflow-x-hidden antialiased text-slate-800">
    <div class="flex min-h-screen">
        
        <!-- SIDEBAR -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 transition-transform -translate-x-full bg-slate-900 border-r border-slate-800 lg:translate-x-0 lg:static lg:flex lg:flex-col lg:h-screen shrink-0">
            <!-- Sidebar Header -->
            <div class="flex items-center gap-3 px-6 py-5 border-b border-slate-800">
                <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 shadow-md shadow-emerald-500/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-lg font-bold tracking-tight text-white">SIPERUKA</h1>
                    <p class="text-xs font-semibold tracking-wider uppercase text-emerald-400">Validator Lapangan</p>
                </div>
            </div>

            <!-- Profile Overview -->
            <div class="px-6 py-6 border-b border-slate-800 bg-slate-950/40">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-bold text-sm">
                            SP
                        </div>
                        <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-500 border-2 border-slate-900 rounded-full"></span>
                    </div>
                    <div class="overflow-hidden">
                        <h4 class="text-sm font-semibold text-white truncate">Pak Budi</h4>
                        <p class="text-xs text-slate-400 truncate">Satpam / Validator</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
                <a href="/satpam/dashboard" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-white bg-emerald-600/10 border border-emerald-500/20 rounded-xl transition-all duration-200 group shadow-sm shadow-emerald-500/5">
                    <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v1m6 11h2m-6 4h-2m6-4a6 6 0 11-12 0 6 6 0 0112 0zm-8-6a2 2 0 114 0 2 2 0 01-4 0z"></path>
                    </svg>
                    Scan QR Code
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-slate-400 rounded-xl hover:bg-slate-800/60 hover:text-white transition-all duration-200 group">
                    <svg class="w-5 h-5 text-slate-400 group-hover:text-emerald-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Jadwal Hari Ini
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-slate-400 rounded-xl hover:bg-slate-800/60 hover:text-white transition-all duration-200 group">
                    <svg class="w-5 h-5 text-slate-400 group-hover:text-emerald-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    Riwayat Validasi
                </a>
            </nav>

            <!-- Logout Link -->
            <div class="p-4 border-t border-slate-800">
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-rose-400 hover:bg-rose-500/10 hover:text-rose-300 rounded-xl transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Keluar Sistem
                </a>
            </div>
        </aside>

        <!-- MAIN CONTENT CONTAINER -->
        <div class="flex flex-col flex-1 min-w-0">
            
            <!-- HEADER -->
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-slate-200/80 shadow-sm shadow-slate-100/50">
                <button id="sidebar-toggle" class="p-2 text-slate-500 rounded-lg lg:hidden hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <div class="flex items-center gap-2">
                    <h2 class="text-xl font-bold tracking-tight text-slate-800">Sistem Perizinan Ruangan</h2>
                </div>

                <div class="flex items-center gap-4">
                    <div class="hidden sm:flex flex-col items-end">
                        <span class="text-sm font-semibold text-slate-700">Pak Budi</span>
                        <span class="text-xs font-medium text-emerald-600">Satpam / Lapangan</span>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-650 flex items-center justify-center text-white font-bold text-sm shadow-md shadow-emerald-500/10">
                        PB
                    </div>
                </div>
            </header>

            <!-- MAIN CONTENT AREA -->
            <main class="flex-1 px-6 py-8 md:px-8 max-w-5xl">
                @yield('content')
            </main>
        </div>

    </div>

    <!-- Mobile Sidebar Toggle -->
    <script>
        const toggleBtn = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');

        toggleBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            sidebar.classList.toggle('-translate-x-full');
        });

        document.addEventListener('click', (e) => {
            if (!sidebar.contains(e.target) && e.target !== toggleBtn) {
                sidebar.classList.add('-translate-x-full');
            }
        });
    </script>
</body>
</html>
