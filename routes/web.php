<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PenempatanController;

use Illuminate\Support\Facades\Route;

// Guest
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // CRUD untuk nilai UTP (admin only)
    Route::middleware('role:admin')->group(function () {
        Route::resource('mahasiswa', MahasiswaController::class);
        Route::resource('perusahaan', PerusahaanController::class);
        Route::resource('penempatan', PenempatanController::class);
    });

    // Perusahaan hanya edit profilnya sendiri (opsional, nanti dibikin)
    Route::middleware('role:perusahaan')->group(function () {
        Route::get('/perusahaan/profil', fn() => view('perusahaan.profil')); // placeholder
    });
});

// Root
Route::get('/', fn() => redirect('/dashboard'));
