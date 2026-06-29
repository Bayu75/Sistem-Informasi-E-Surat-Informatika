<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengumumanController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Mahasiswa\PengajuanSuratController;
use App\Http\Controllers\Admin\VerifikasiController;
    
use App\Http\Controllers\Mahasiswa\DashboardController;

// Landing Page
Route::get('/', function () {

    if (Auth::check()) {

        return match (Auth::user()->role) {
            'mahasiswa' => redirect('/mahasiswa/dashboard'),
            'admin' => redirect('/admin/dashboard'),
            'kaprodi' => redirect('/kaprodi/dashboard'),
        };
    }

    return view('landing-page');
});

// Login
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'index'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'authenticate']);
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


// ==============================
// MAHASISWA
// ==============================

Route::prefix('mahasiswa')
    ->middleware(['auth', 'role:mahasiswa'])
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('mahasiswa.dashboard');

        // Pengumuman
        Route::view('/pengumuman', 'mahasiswa.pengumuman');

        // Ajukan Surat
        Route::get(
            '/ajukan',
            [PengajuanSuratController::class, 'create']
        )->name('pengajuan.create');

        Route::post(
            '/ajukan',
            [PengajuanSuratController::class, 'store']
        )->name('pengajuan.store');

        // Status Pengajuan
        Route::get(
            '/status',
            [PengajuanSuratController::class, 'status']
        )->name('pengajuan.status');

        Route::get(
        '/riwayat',
        [PengajuanSuratController::class, 'riwayat']
        )->name('pengajuan.riwayat');

        // Download Template
        Route::get(
            '/template/{id}',
            [PengajuanSuratController::class, 'downloadTemplate']
        )->name('template.download');

        Route::get(
            '/status/{id}',
            [PengajuanSuratController::class, 'status']
        )->name('pengajuan.status');
});

Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        Route::view('/dashboard', 'admin.dashboard');

        Route::view('/pengajuan-masuk', 'admin.pengajuan-masuk');

        Route::view('/verifikasi', 'admin.verifikasi');

        Route::view('/teruskan', 'admin.teruskan');
        Route::get('/pengumuman', [PengumumanController::class, 'index']);
        Route::post('/pengumuman', [PengumumanController::class, 'store'])
            ->name('admin.pengumuman.store');
        Route::delete('/pengumuman/{pengumuman}', [PengumumanController::class, 'destroy'])
            ->name('admin.pengumuman.destroy');
        Route::get('/pengumuman/{pengumuman}/lihat', [PengumumanController::class, 'lihat'])
            ->name('admin.pengumuman.lihat');
        Route::get('/pengumuman/{pengumuman}/download', [PengumumanController::class, 'download'])
            ->name('admin.pengumuman.download');

        Route::view('/pengumuman', 'admin.pengumuman');

        Route::view('/arsip', 'admin.arsip');

        Route::get(
            '/pengajuan-masuk',
            [VerifikasiController::class, 'index']
        )->name('admin.pengajuan');

        Route::put(
            '/pengajuan/{id}/verifikasi',
            [VerifikasiController::class, 'verifikasi']
        )->name('admin.verifikasi');

        Route::put(
            '/pengajuan/{id}/tolak',
            [VerifikasiController::class, 'tolak']
        )->name('admin.tolak');
});

Route::prefix('kaprodi')
    ->middleware(['auth', 'role:kaprodi'])
    ->group(function () {

        Route::view('/dashboard', 'kaprodi.dashboard');

        Route::view('/persetujuan-pengajuan', 'kaprodi.persetujuan-pengajuan');

        Route::view('/riwayat', 'kaprodi.riwayat');

        Route::view('/pengumuman', 'kaprodi.pengumuman');
    });