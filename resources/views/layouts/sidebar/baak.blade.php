<!-- Dashboard Link -->
<a href="{{ route('dashboard.baak') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold {{ request()->routeIs('dashboard.baak') ? 'text-blue-600 bg-blue-50/70 rounded-xl' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900 rounded-xl transition-all duration-200 group' }}">
    <svg class="w-5 h-5 {{ request()->routeIs('dashboard.baak') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path>
    </svg>
    Dashboard
</a>

<!-- Verifikasi Pengajuan Link -->
<a href="{{ route('dashboard.baak') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold {{ request()->routeIs('dashboard.baak') ? 'text-blue-600 bg-blue-50/70 rounded-xl' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900 rounded-xl transition-all duration-200 group' }}">
    <svg class="w-5 h-5 {{ request()->routeIs('dashboard.baak') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
    </svg>
    Verifikasi Pengajuan
</a>

<!-- Kelola Ruangan Link -->
<a href="{{ route('baak.ruangan.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold {{ request()->routeIs('baak.ruangan*') ? 'text-blue-600 bg-blue-50/70 rounded-xl' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900 rounded-xl transition-all duration-200 group' }}">
    <svg class="w-5 h-5 {{ request()->routeIs('baak.ruangan*') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
    </svg>
    Kelola Ruangan
</a>
