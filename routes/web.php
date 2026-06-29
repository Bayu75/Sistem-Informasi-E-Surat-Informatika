<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Mahasiswa\PengajuanSuratController;
use App\Http\Controllers\Admin\VerifikasiController;
    

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

        Route::view('/dashboard', 'admin.dashboard');
        Route::view('/verifikasi', 'admin.verifikasi');
        Route::view('/teruskan', 'admin.teruskan');
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

// kaprodi
Route::prefix('kaprodi')
    ->middleware(['auth', 'role:kaprodi'])
    ->group(function () {

        Route::view('/dashboard', 'kaprodi.dashboard');
        Route::view('/persetujuan-pengajuan', 'kaprodi.persetujuan-pengajuan');
        Route::view('/riwayat', 'kaprodi.riwayat');
        Route::view('/pengumuman', 'kaprodi.pengumuman');
});
