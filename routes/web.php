<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SatpamController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

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

    // 1. Dashboard Sub-routes
    Route::prefix('dashboard')->group(function () {
        Route::get('/mahasiswa', [DashboardController::class, 'mahasiswa'])->middleware(['role:mahasiswa'])->name('dashboard.mahasiswa');
        Route::get('/baak', [DashboardController::class, 'baak'])->middleware(['role:baak'])->name('dashboard.baak');
        Route::get('/satpam', [DashboardController::class, 'satpam'])->middleware(['role:satpam'])->name('dashboard.satpam');
    });

    // 2. Functional Portal Routes (Mahasiswa)
    Route::middleware(['role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/pengajuan', function () {
            return view('mahasiswa.pengajuan');
        })->name('pengajuan');
    });

    // 3. Functional Portal Routes (Satpam)
    Route::middleware(['role:satpam'])->prefix('satpam')->name('satpam.')->group(function () {
        Route::post('/verify', [SatpamController::class, 'verifyQr'])->name('verify');
    });
});
