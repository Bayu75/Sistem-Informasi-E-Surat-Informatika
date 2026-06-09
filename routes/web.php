<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Landing Page
Route::get('/landing-page', function () {
    return view('landing-page');
});

// Login
Route::get('/login', function () {
    return view('auth.login');
});

// Admin TU
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/admin/pengajuan-masuk', function () {
    return view('admin.pengajuan-masuk');
});

Route::get('/admin/verifikasi', function () {
    return view('admin.verifikasi');
});

Route::get('/admin/teruskan', function () {
    return view('admin.teruskan');
});

Route::get('/admin/pengumuman', function () {
    return view('admin.pengumuman');
});

Route::get('/admin/arsip', function () {
    return view('admin.arsip');
});

// Mahasiswa
Route::get('/mahasiswa/dashboard', function () {
    return view('mahasiswa.dashboard');
});

Route::get('/mahasiswa/pengumuman', function () {
    return view('mahasiswa.pengumuman');
});

Route::get('/mahasiswa/ajukan', function () {
    return view('mahasiswa.ajukan');
});

Route::get('/mahasiswa/status', function () {
    return view('mahasiswa.status');
});

Route::get('/mahasiswa/riwayat', function () {
    return view('mahasiswa.riwayat');
});

// Kaprodi
Route::get('/kaprodi/dashboard', function () {
    return view('kaprodi.dashboard');
});

Route::get('/kaprodi/persetujuan-pengajuan', function () {
    return view('kaprodi.persetujuan-pengajuan');
});

Route::get('/kaprodi/riwayat', function () {
    return view('kaprodi.riwayat');
});

Route::get('/kaprodi/pengumuman', function () {
    return view('kaprodi.pengumuman');
});