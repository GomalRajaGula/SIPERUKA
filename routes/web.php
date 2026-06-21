<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SatpamController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SettingsController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Google Authentication Routes
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Generic Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Route Group protected by auth & role middleware
Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Settings Routes
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password');

    // 1. Dashboard Sub-routes
    Route::prefix('dashboard')->group(function () {
        Route::get('/mahasiswa', [DashboardController::class, 'mahasiswa'])->middleware(['role:mahasiswa'])->name('dashboard.mahasiswa');
        Route::get('/baak', [DashboardController::class, 'baak'])->middleware(['role:baak'])->name('dashboard.baak');
        Route::get('/satpam', [DashboardController::class, 'satpam'])->middleware(['role:satpam'])->name('dashboard.satpam');
    });

    // 2. Functional Portal Routes (Mahasiswa)
    Route::middleware(['role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/buat-pengajuan', [PengajuanController::class, 'create'])->name('buat-pengajuan');
        Route::post('/buat-pengajuan', [PengajuanController::class, 'store'])->name('buat-pengajuan.store');
    });

    // 3. Functional Portal Routes (BAAK)
    Route::middleware(['role:baak'])->prefix('baak')->name('baak.')->group(function () {
        // Pengajuan actions
        Route::get('/pengajuan/{id}', [DashboardController::class, 'showDetail'])->name('pengajuan.detail');
        Route::post('/pengajuan/{id}/approve', [DashboardController::class, 'approve'])->name('pengajuan.approve');
        Route::post('/pengajuan/{id}/reject', [DashboardController::class, 'reject'])->name('pengajuan.reject');

        // Kelola Ruangan (CRUD)
        Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan.index');
        Route::post('/ruangan', [RuanganController::class, 'store'])->name('ruangan.store');
        Route::put('/ruangan/{id}', [RuanganController::class, 'update'])->name('ruangan.update');
        Route::delete('/ruangan/{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');
    });

    // 4. Functional Portal Routes (Satpam)
    Route::middleware(['role:satpam'])->prefix('satpam')->name('satpam.')->group(function () {
        Route::post('/verify', [SatpamController::class, 'verifyQr'])->name('verify');
    });
});
