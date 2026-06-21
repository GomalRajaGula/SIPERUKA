<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SatpamController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Route Login Placeholder
Route::get('/login', function () {
    return 'Halaman Login - Silakan Autentikasi';
})->name('login');

// Google Authentication Routes
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Dashboard Route Placeholder
Route::get('/dashboard', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;
        return redirect()->route($role . '.dashboard');
    }
    return redirect()->route('login');
})->middleware(['auth'])->name('dashboard');

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
        Route::get('/dashboard', [SatpamController::class, 'dashboard'])->name('dashboard');
        Route::post('/verify', [SatpamController::class, 'verifyQr'])->name('verify');
    });
});
