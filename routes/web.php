<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\PengumumanController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Mahasiswa\PengajuanSuratController;
use App\Http\Controllers\Admin\VerifikasiController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Mahasiswa\PengumumanController as MahasiswaPengumumanController;
use App\Models\Pengumuman;

// Landing Page
Route::get('/', function () {
    
    if (Auth::check()) {

        return match (Auth::user()->role) {
            'mahasiswa' => redirect('/mahasiswa/dashboard'),
            'admin' => redirect('/admin/dashboard'),
            'kaprodi' => redirect('/kaprodi/dashboard'),
        };
    }

    $pengumuman = Pengumuman::where('status', 'Aktif')
        ->orderByDesc('tanggal')
        ->get();

    return view('landing-page', compact('pengumuman'));
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

        Route::view('/dashboard', 'kaprodi.dashboard');

        Route::view('/persetujuan-pengajuan', 'kaprodi.persetujuan-pengajuan');

        Route::view('/riwayat', 'kaprodi.riwayat');

        Route::get('/pengumuman', [PengumumanController::class, 'kaprodi'])
        ->name('kaprodi.pengumuman');

        Route::get('/pengumuman/{pengumuman}/lihat', [PengumumanController::class, 'lihat'])
        ->name('kaprodi.pengumuman.lihat');

        Route::get('/pengumuman/{pengumuman}/download', [PengumumanController::class, 'download'])
        ->name('kaprodi.pengumuman.download');
      
        Route::get('/debug-auth', function () {
        return [
        'check' => auth()->check(),
        'user' => auth()->user(),
        'session_id' => session()->getId(),
            ];
        });

    });
