<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use Illuminate\Support\Facades\Auth;

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
            'diteruskan_ke_kaprodi'
        ])
        ->count();

        $disetujui = PengajuanSurat::where(
            'mahasiswa_id',
            $mahasiswa->id
        )
        ->where('status', 'disetujui')
        ->count();

        $ditolak = PengajuanSurat::where(
            'mahasiswa_id',
            $mahasiswa->id
        )
        ->where('status', 'ditolak')
        ->count();

        $pengajuanAktif = PengajuanSurat::with('jenisSurat')
            ->where('mahasiswa_id', $mahasiswa->id)
            ->whereIn('status', [
                'menunggu_verifikasi',
                'diteruskan_ke_kaprodi'
            ])
            ->latest()
            ->take(5)
            ->get();

        return view('mahasiswa.dashboard', compact(
            'totalPengajuan',
            'sedangDiproses',
            'disetujui',
            'ditolak',
            'pengajuanAktif'
        ));
    }
}