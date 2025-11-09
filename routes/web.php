<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PenempatanController;
use App\Http\Controllers\AbsensiController;

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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // CRUD untuk nilai UTP (admin only)
    Route::middleware('role:admin')->group(function () {
        Route::resource('mahasiswa', MahasiswaController::class);
        Route::resource('perusahaan', PerusahaanController::class);
        Route::resource('penempatan', PenempatanController::class);
    });

    // Perusahaan: profil sendiri
    Route::middleware('role:perusahaan')->group(function () {
        // gunakan path unik agar tidak bentrok dengan resource('perusahaan')
        Route::get('/profil-perusahaan', [PerusahaanController::class, 'profile'])->name('perusahaan.profil');
        Route::post('/profil-perusahaan', [PerusahaanController::class, 'updateProfile'])->name('perusahaan.profil.update');
        Route::get('/magang/{penempatan}', [PerusahaanController::class, 'magangDetail'])->name('perusahaan.magang.detail');
    });

    // Absensi untuk mahasiswa
    Route::middleware('role:mahasiswa')->group(function () {
        Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
        Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');
        Route::get('/absensi/rekap', [AbsensiController::class, 'rekap'])->name('absensi.rekap');
    });
});

// Root
Route::get('/', fn() => redirect('/dashboard'));
