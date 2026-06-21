@extends('layouts.app')

@section('title', 'Pengaturan Profil')

@section('header', 'Pengaturan Profil')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">

    <!-- Profile Information Form -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center gap-3">
            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-blue-50 text-blue-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-slate-900">Informasi Profil</h3>
                <p class="text-sm text-slate-500">Perbarui informasi profil dan alamat email akun Anda.</p>
            </div>
        </div>

        <form action="{{ route('settings.profile') }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Lengkap -->
                <div class="space-y-1.5 md:col-span-2">
                    <label for="nama" class="text-sm font-semibold text-slate-700">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" required value="{{ old('nama', $user->nama) }}" class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    @error('nama')
                        <p class="text-xs font-semibold text-rose-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- NIM / Username -->
                <div class="space-y-1.5">
                    <label for="username" class="text-sm font-semibold text-slate-700">NIM / Username</label>
                    <input type="text" id="username" name="username" required value="{{ old('username', $user->username) }}" class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    @error('username')
                        <p class="text-xs font-semibold text-rose-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="space-y-1.5">
                    <label for="email" class="text-sm font-semibold text-slate-700">Alamat Email</label>
                    <input type="email" id="email" name="email" required value="{{ old('email', $user->email) }}" class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    @error('email')
                        <p class="text-xs font-semibold text-rose-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 active:scale-95 text-white font-semibold text-sm rounded-xl transition-all shadow-sm shadow-blue-500/30">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- Password Update Form -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center gap-3">
            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-slate-900">Perbarui Password</h3>
                <p class="text-sm text-slate-500">Pastikan akun Anda menggunakan password panjang yang acak agar tetap aman.</p>
            </div>
        </div>

        <form action="{{ route('settings.password') }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Current Password -->
                <div class="space-y-1.5 md:col-span-2">
                    <label for="current_password" class="text-sm font-semibold text-slate-700">Password Saat Ini</label>
                    <input type="password" id="current_password" name="current_password" required class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    @error('current_password')
                        <p class="text-xs font-semibold text-rose-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="space-y-1.5">
                    <label for="password" class="text-sm font-semibold text-slate-700">Password Baru</label>
                    <input type="password" id="password" name="password" required class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    @error('password')
                        <p class="text-xs font-semibold text-rose-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="space-y-1.5">
                    <label for="password_confirmation" class="text-sm font-semibold text-slate-700">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 active:scale-95 text-white font-semibold text-sm rounded-xl transition-all shadow-sm shadow-indigo-500/30">
                    Perbarui Password
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
