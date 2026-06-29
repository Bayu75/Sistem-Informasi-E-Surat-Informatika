<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use App\Models\Pengumuman;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Statistik
        $totalPengajuan = PengajuanSurat::count();

        $menungguVerifikasi = PengajuanSurat::where(
            'status',
            'menunggu_verifikasi'
        )->count();

        $sudahDiverifikasi = PengajuanSurat::where(
            'status',
            'diverifikasi_admin'
        )->count();

        $pengumumanAktif = Pengumuman::where('status', 'aktif')->count();

        // 5 Pengajuan terbaru
        $pengajuanTerbaru = PengajuanSurat::with([
                'mahasiswa',
                'jenisSurat'
            ])
            ->latest('tanggal_pengajuan')
            ->take(5)
            ->get()
            ->map(function ($item) {

                return [
                    'id'      => $item->id,
                    'nama'    => $item->mahasiswa->nama,
                    'nim'     => $item->mahasiswa->nim,
                    'jenis'   => $item->jenisSurat->nama_surat,
                    'tanggal' => $item->tanggal_pengajuan
                                        ->format('d M Y'),

                    'status' => match ($item->status) {

                        'menunggu_verifikasi'
                            => 'Menunggu Verifikasi',

                        'diverifikasi_admin'
                            => 'Diverifikasi Admin',

                        'disetujui_kaprodi'
                            => 'Disetujui Kaprodi',

                        'ditolak_admin'
                            => 'Ditolak Admin',

                        'ditolak_kaprodi'
                            => 'Ditolak Kaprodi',

                        default => '-'
                    }
                ];
            });

        return view('admin.dashboard', compact(
            'totalPengajuan',
            'menungguVerifikasi',
            'sudahDiverifikasi',
            'pengumumanAktif',
            'pengajuanTerbaru'
        ));
    }
}