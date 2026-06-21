<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Perizinan Ruangan') - SIPERUKA PNC</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50 antialiased text-slate-800">
    <div class="flex min-h-screen">
        
        <!-- SIDEBAR (LEFT) -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 transition-transform -translate-x-full bg-white border-r border-slate-200 lg:translate-x-0 lg:static lg:flex lg:flex-col lg:h-screen shrink-0 shadow-sm">
            <!-- Sidebar Header / Branding -->
            <div class="flex items-center gap-3 px-6 py-5 border-b border-slate-100">
                <img src="{{ asset('images/logo.png') }}" alt="SIPERUKA Logo" class="h-10 w-auto rounded-lg shadow-sm">
                <div>
                    <h1 class="text-sm font-extrabold tracking-tight text-slate-900 leading-tight">SIPERUKA PNC</h1>
                    <p class="text-xxs font-bold tracking-wider uppercase text-blue-600 mt-0.5">Politeknik Negeri Cilacap</p>
                </div>
            </div>

            <!-- Dynamic Menu Logic depending on Role -->
            @auth
            <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
                @include('layouts.sidebar.' . auth()->user()->role)
            </nav>
            @endauth

            <!-- Sidebar Bottom: Settings / Logout -->
            @auth
            <div class="p-4 border-t border-slate-100 space-y-1">
                <a href="{{ route('settings.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-xs font-semibold text-slate-500 hover:bg-slate-50 hover:text-slate-800 rounded-xl transition-all duration-200">
                    <svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Pengaturan
                </a>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-rose-600 hover:bg-rose-50 hover:text-rose-700 rounded-xl transition-all duration-200">
                    <svg class="w-4.5 h-4.5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Keluar (Logout)
                </a>
            </div>
            @endauth
        </aside>

        <!-- MAIN CONTENT AREA (RIGHT) -->
        <div class="flex flex-col flex-1 min-w-0">
            
            <!-- TOP NAVBAR -->
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-slate-200 shadow-sm shrink-0">
                <div class="flex items-center gap-4 flex-1">
                    <!-- Hamburger menu toggle for mobile -->
                    <button id="sidebar-toggle" class="p-2 text-slate-500 rounded-lg lg:hidden hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-blue-500/15 shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    
                    <!-- Search Input (Left) -->
                    <div class="relative w-full max-w-xs hidden sm:block">
                        <input type="text" placeholder="Cari..." class="w-full pl-9 pr-4 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/15 focus:border-blue-500 transition-all duration-200 text-slate-700 placeholder-slate-400">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- User Profile & Notifications -->
                <div class="flex items-center gap-4.5">
                    @auth
                    <!-- Profile Overview -->
                    <div class="flex items-center gap-3">
                        <div class="hidden sm:flex flex-col items-end">
                            <span class="text-xs font-bold text-slate-800 leading-tight">{{ auth()->user()->nama }}</span>
                            <span class="text-xxs text-slate-400 font-semibold capitalize">{{ auth()->user()->role }}</span>
                        </div>
                        
                        <!-- Initial Avatar with custom gradient -->
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-650 flex items-center justify-center text-white font-extrabold text-xs border border-blue-400/10 shadow shadow-blue-500/5">
                            {{ strtoupper(substr(auth()->user()->nama, 0, 2)) }}
                        </div>
                    </div>
                    @endauth
                </div>
            </header>

            <!-- CONTENT BODY AREA -->
            <main class="flex-1 bg-slate-50 px-6 py-8 md:px-8 max-w-5xl overflow-y-auto">
                @yield('content')
            </main>
        </div>

    </div>

    <!-- Sidebar Toggle Script on Mobile -->
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
