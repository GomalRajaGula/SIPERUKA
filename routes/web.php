<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route Login Placeholder
Route::get('/login', function () {
    return 'Halaman Login - Silakan Autentikasi';
})->name('login');

// Route Group protected by auth & role middleware
Route::middleware(['auth'])->group(function () {

    // 1. Mahasiswa (Pemohon) Routes
    Route::middleware(['role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/dashboard', function () {
            return 'Dashboard Mahasiswa';
        })->name('dashboard');

        Route::get('/pengajuan', function () {
            return view('mahasiswa.pengajuan');
        })->name('pengajuan');
    });

    // 2. BAAK (Verifikator) Routes
    Route::middleware(['role:baak'])->prefix('baak')->name('baak.')->group(function () {
        Route::get('/dashboard', function () {
            return 'Dashboard BAAK - Verifikator';
        })->name('dashboard');
    });

    // 3. Satpam (Validator Lapangan) Routes
    Route::middleware(['role:satpam'])->prefix('satpam')->name('satpam.')->group(function () {
        Route::get('/dashboard', function () {
            return 'Dashboard Satpam - Validator';
        })->name('dashboard');
    });
});
