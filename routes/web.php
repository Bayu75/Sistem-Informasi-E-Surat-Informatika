<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

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
        Route::view('/ajukan', 'mahasiswa.ajukan');
        Route::view('/status', 'mahasiswa.status');
        Route::view('/riwayat', 'mahasiswa.riwayat');
});

// admin
Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        Route::view('/dashboard', 'admin.dashboard');
        Route::view('/pengajuan-masuk', 'admin.pengajuan-masuk');
        Route::view('/verifikasi', 'admin.verifikasi');
        Route::view('/teruskan', 'admin.teruskan');
        Route::view('/pengumuman', 'admin.pengumuman');
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
