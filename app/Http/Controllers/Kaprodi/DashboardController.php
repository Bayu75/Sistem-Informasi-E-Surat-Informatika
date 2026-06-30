<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use App\Models\Pengumuman;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik
        $menunggu = PengajuanSurat::where(
            'status',
            'diteruskan_ke_kaprodi'
        )->count();

        $disetujui = PengajuanSurat::where(
            'status',
            'disetujui'
        )->count();

        $ditolak = PengajuanSurat::where(
            'status',
            'ditolak'
        )->count();

        // Pengajuan yang menunggu keputusan
        $pengajuanMenunggu = PengajuanSurat::with([
            'mahasiswa',
            'jenisSurat'
        ])
        ->where('status', 'diteruskan_ke_kaprodi')
        ->latest('tanggal_pengajuan')
        ->take(5)
        ->get();

        $pengumuman = Pengumuman::where('status', 'Aktif')
        ->orderByDesc('tanggal')
        ->take(5)
        ->get();

        return view('kaprodi.dashboard', compact(
            'menunggu',
            'disetujui',
            'ditolak',
            'pengajuanMenunggu',
            'pengumuman'
        ));
    }
}