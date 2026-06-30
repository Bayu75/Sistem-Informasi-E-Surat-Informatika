<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengumumanController;

use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboardController;
use App\Http\Controllers\Mahasiswa\PengajuanSuratController;
use App\Http\Controllers\Mahasiswa\PengumumanController as MahasiswaPengumumanController;

use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\VerifikasiController;

use App\Http\Controllers\Kaprodi\DashboardController as KaprodiDashboardController;

Route::get('/', function () {

    if (Auth::check()) {

        return match (Auth::user()->role) {
            'mahasiswa' => redirect()->route('mahasiswa.dashboard'),
            'admin'     => redirect()->route('admin.dashboard'),
            'kaprodi'   => redirect()->route('kaprodi.dashboard'),
        };
    }

    return view('landing-page');
});

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'index'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'authenticate']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::prefix('mahasiswa')
    ->middleware(['auth', 'role:mahasiswa'])
    ->group(function () {

        Route::get('/dashboard', [MahasiswaDashboardController::class, 'index'])
            ->name('mahasiswa.dashboard');

        Route::get('/pengumuman', [MahasiswaPengumumanController::class, 'index'])
            ->name('mahasiswa.pengumuman');

        Route::get('/pengumuman/{pengumuman}/lihat',
            [MahasiswaPengumumanController::class, 'lihat'])
            ->name('mahasiswa.pengumuman.lihat');

        Route::get('/pengumuman/{pengumuman}/download',
            [MahasiswaPengumumanController::class, 'download'])
            ->name('mahasiswa.pengumuman.download');

        Route::get('/ajukan', [PengajuanSuratController::class, 'create'])
            ->name('pengajuan.create');

        Route::post('/ajukan', [PengajuanSuratController::class, 'store'])
            ->name('pengajuan.store');

        Route::get('/status', [PengajuanSuratController::class, 'status'])
            ->name('pengajuan.status');

        Route::get('/status/{id}', [PengajuanSuratController::class, 'status'])
            ->name('pengajuan.status.detail');

        Route::get('/riwayat', [PengajuanSuratController::class, 'riwayat'])
            ->name('pengajuan.riwayat');

        Route::get('/template/{id}',
            [PengajuanSuratController::class, 'downloadTemplate'])
            ->name('template.download');
    });


Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        Route::get('/dashboard', [DashboardAdminController::class, 'index'])
            ->name('admin.dashboard');

        Route::get('/pengajuan-masuk', [VerifikasiController::class, 'index'])
            ->name('admin.pengajuan');

        Route::put('/pengajuan/{id}/verifikasi',
            [VerifikasiController::class, 'verifikasi'])
            ->name('admin.verifikasi');

        Route::put('/pengajuan/{id}/tolak',
            [VerifikasiController::class, 'tolak'])
            ->name('admin.tolak');

        Route::get('/arsip',
            [VerifikasiController::class, 'arsip'])
            ->name('admin.arsip');

        Route::view('/verifikasi', 'admin.verifikasi');
        Route::view('/teruskan', 'admin.teruskan');

        Route::get('/pengumuman',
            [PengumumanController::class, 'index'])
            ->name('admin.pengumuman');

        Route::post('/pengumuman',
            [PengumumanController::class, 'store'])
            ->name('admin.pengumuman.store');

        Route::delete('/pengumuman/{pengumuman}',
            [PengumumanController::class, 'destroy'])
            ->name('admin.pengumuman.destroy');

        Route::get('/pengumuman/{pengumuman}/lihat',
            [PengumumanController::class, 'lihat'])
            ->name('admin.pengumuman.lihat');

        Route::get('/pengumuman/{pengumuman}/download',
            [PengumumanController::class, 'download'])
            ->name('admin.pengumuman.download');
    });


Route::prefix('kaprodi')
    ->middleware(['auth', 'role:kaprodi'])
    ->group(function () {

        // Dashboard
        Route::get('/dashboard',
            [KaprodiDashboardController::class, 'index'])
            ->name('kaprodi.dashboard');

        // Persetujuan
        Route::view('/persetujuan-pengajuan',
            'kaprodi.persetujuan-pengajuan');

        // Riwayat
        Route::view('/riwayat',
            'kaprodi.riwayat');

        // Pengumuman
        Route::get('/pengumuman',
            [PengumumanController::class, 'kaprodi'])
            ->name('kaprodi.pengumuman');

        Route::get('/pengumuman/{pengumuman}/lihat',
            [PengumumanController::class, 'lihat'])
            ->name('kaprodi.pengumuman.lihat');

        Route::get('/pengumuman/{pengumuman}/download',
            [PengumumanController::class, 'download'])
            ->name('kaprodi.pengumuman.download');

        // Debug (opsional)
        Route::get('/debug-auth', function () {
            return [
                'check' => auth()->check(),
                'user' => auth()->user(),
                'session_id' => session()->getId(),
            ];
        });
    });