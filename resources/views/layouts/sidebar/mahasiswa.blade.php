<!-- Dashboard Link -->
<a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold {{ request()->routeIs('dashboard*') && !request()->routeIs('mahasiswa.buat-pengajuan') ? 'text-blue-600 bg-blue-50/70 rounded-xl' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900 rounded-xl transition-all duration-200 group' }}">
    <svg class="w-5 h-5 {{ request()->routeIs('dashboard*') && !request()->routeIs('mahasiswa.buat-pengajuan') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path>
    </svg>
    Dashboard
</a>

<!-- Pengajuan Link -->
<a href="{{ route('mahasiswa.buat-pengajuan') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold {{ request()->routeIs('mahasiswa.buat-pengajuan') ? 'text-blue-600 bg-blue-50/70 rounded-xl' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900 rounded-xl transition-all duration-200 group' }}">
    <svg class="w-5 h-5 {{ request()->routeIs('mahasiswa.buat-pengajuan') ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
    </svg>
    Pengajuan
</a>
