<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengumuman;

class DashboardController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $totalPengajuan = PengajuanSurat::where(
            'mahasiswa_id',
            $mahasiswa->id
        )->count();

        $sedangDiproses = PengajuanSurat::where(
            'mahasiswa_id',
            $mahasiswa->id
        )
        ->whereIn('status', [
            'menunggu_verifikasi',
            'diverifikasi_admin'
        ])
        ->count();

        $disetujui = PengajuanSurat::where(
            'mahasiswa_id',
            $mahasiswa->id
        )
        ->where('status', 'disetujui_kaprodi')
        ->count();

        $ditolak = PengajuanSurat::where(
            'mahasiswa_id',
            $mahasiswa->id
        )
        ->where('status', [
            'ditolak_admin',
            'ditolak_kaprodi'
        ])
        ->count();

        $pengajuanAktif = PengajuanSurat::with('jenisSurat')
            ->where('mahasiswa_id', $mahasiswa->id)
            ->whereIn('status', [
                'menunggu_verifikasi',
                'diverifikasi_admin',
                'ditolak_admin',
                'disetujui_kaprodi',
                'ditolak_kaprodi'
            ])
            ->latest()
            ->take(5)
            ->get();

        $pengumumanTerbaru = Pengumuman::where('status', 'Aktif')
            ->orderBy('tanggal', 'desc')
            ->take(5)
            ->get();

        return view('mahasiswa.dashboard', compact(
            'totalPengajuan',
            'sedangDiproses',
            'disetujui',
            'ditolak',
            'pengajuanAktif',
            'pengumumanTerbaru'
        ));
    }
}