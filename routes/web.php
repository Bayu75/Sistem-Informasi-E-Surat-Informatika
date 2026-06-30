<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\PengumumanController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Mahasiswa\PengajuanSuratController;
use App\Http\Controllers\Admin\VerifikasiController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Kaprodi\PersetujuanController;
use App\Http\Controllers\Mahasiswa\PengumumanController as MahasiswaPengumumanController;
use App\Http\Controllers\Kaprodi\DashboardController as KaprodiDashboardController;
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
        Route::get('/pengumuman', [MahasiswaPengumumanController::class, 'index'])
            ->name('mahasiswa.pengumuman');

        Route::get('/pengumuman/{pengumuman}/lihat',
            [MahasiswaPengumumanController::class, 'lihat']
        )->name('mahasiswa.pengumuman.lihat');

        Route::get('/pengumuman/{pengumuman}/download',
            [MahasiswaPengumumanController::class, 'download']
        )->name('mahasiswa.pengumuman.download');
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

        Route::get(
            '/pengajuan/{pengajuan}/download',
            [PengajuanSuratController::class, 'downloadSurat']
        )->name('mahasiswa.pengajuan.download');
});

Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        Route::get(
            '/dashboard',
            [DashboardAdminController::class, 'index']
        )->name('admin.dashboard');

        Route::get('/pengumuman', [PengumumanController::class, 'index']);
        Route::post('/pengumuman', [PengumumanController::class, 'store'])
            ->name('admin.pengumuman.store');
        Route::delete('/pengumuman/{pengumuman}', [PengumumanController::class, 'destroy'])
            ->name('admin.pengumuman.destroy');
        Route::get('/pengumuman/{pengumuman}/lihat', [PengumumanController::class, 'lihat'])
            ->name('admin.pengumuman.lihat');
        Route::get('/pengumuman/{pengumuman}/download', [PengumumanController::class, 'download'])
            ->name('admin.pengumuman.download');

        Route::get(
            '/arsip',
            [VerifikasiController::class, 'arsip']
        )->name('admin.arsip');

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
    ->middleware(['auth', 'role:kaprodi,admin'])
    ->group(function () {

        Route::get('/dashboard', [KaprodiDashboardController::class, 'index'])
            ->name('kaprodi.dashboard');
        Route::get('/persetujuan-pengajuan', [PersetujuanController::class, 'index'])
            ->name('kaprodi.persetujuan');

         Route::get('/riwayat', [PersetujuanController::class, 'riwayat'])
            ->name('kaprodi.riwayat');

            Route::get('/pengumuman', [PengumumanController::class, 'kaprodi'])
        ->name('kaprodi.pengumuman');

        Route::get('/pengumuman/{pengumuman}/lihat', [PengumumanController::class, 'lihat'])
        ->name('kaprodi.pengumuman.lihat');

        Route::get('/pengumuman/{pengumuman}/download', [PengumumanController::class, 'download'])
        ->name('kaprodi.pengumuman.download');

        Route::put(
            '/persetujuan-pengajuan/{pengajuan}/setujui',
            [PersetujuanController::class, 'setujui']
        )->name('kaprodi.persetujuan.setujui');

        Route::put(
            '/persetujuan-pengajuan/{pengajuan}/tolak',
            [PersetujuanController::class, 'tolak']
        )->name('kaprodi.persetujuan.tolak');

        Route::get('/debug-auth', function () {
        return [
        'check' => auth()->check(),
        'user' => auth()->user(),
        'session_id' => session()->getId(),
            ];
        });

    });
