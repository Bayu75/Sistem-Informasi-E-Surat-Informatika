<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use App\Models\Pengumuman;

class DashboardController extends Controller
{
    public function index()
    {
        $menunggu = PengajuanSurat::where('status', 'diverifikasi_admin')->count();

        $disetujui = PengajuanSurat::where('status', 'disetujui_kaprodi')->count();

        $ditolak = PengajuanSurat::where('status', 'ditolak_kaprodi')->count();

        $pengajuan = PengajuanSurat::with(['mahasiswa', 'jenisSurat'])
            ->where('status', 'diverifikasi_admin')
            ->latest('tanggal_verifikasi_admin')
            ->get();

        $pengumuman = Pengumuman::where('status', 'Aktif')
            ->orderBy('tanggal', 'desc')
            ->take(2)
            ->get();

        return view('kaprodi.dashboard', compact(
            'menunggu',
            'disetujui',
            'ditolak',
            'pengajuan',
            'pengumuman'
        ));
    }
}
