<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengumumanController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Mahasiswa\PengajuanSuratController;
    

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

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// mahasiswa
Route::prefix('mahasiswa')
    ->middleware(['auth', 'role:mahasiswa'])
    ->group(function () {

        Route::view('/dashboard', 'mahasiswa.dashboard');

        Route::view('/pengumuman', 'mahasiswa.pengumuman');

        Route::get(
            '/ajukan',
            [PengajuanSuratController::class, 'create']
        )->name('pengajuan.create');

        Route::post(
            '/ajukan',
            [PengajuanSuratController::class, 'store']
        )->name('pengajuan.store');

        Route::get(
            '/status',
            [PengajuanSuratController::class, 'status']
        )->name('pengajuan.status');

        Route::view('/riwayat', 'mahasiswa.riwayat');

        Route::get(
            '/template/{id}',
            [PengajuanSuratController::class, 'downloadTemplate']
        )->name('template.download');
});

// admin
Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        Route::view('/dashboard', 'admin.dashboard');      Route::view('/pengajuan-masuk', 'admin.pengajuan-masuk');
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
        Route::view('/arsip', 'admin.arsip');
});

// kaprodi
Route::prefix('kaprodi')
    ->middleware(['auth', 'role:kaprodi'])
    ->group(function () {

        Route::view('/dashboard', 'kaprodi.dashboard');
        Route::view('/persetujuan-pengajuan', 'kaprodi.persetujuan-pengajuan');
        Route::view('/riwayat', 'kaprodi.riwayat');
        Route::view('/pengumuman', 'kaprodi.pengumuman');
});
