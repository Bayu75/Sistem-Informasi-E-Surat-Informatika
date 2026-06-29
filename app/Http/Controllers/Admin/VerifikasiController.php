<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use App\Models\JenisSurat;

class VerifikasiController extends Controller
{
    public function index()
    {
        $pengajuan = PengajuanSurat::with([
            'mahasiswa',
            'jenisSurat'
        ])
        ->whereIn('status', [
            'menunggu_verifikasi',
            'diverifikasi_admin',
            'ditolak_admin'
        ])
        ->latest()
        ->get();

        $jenisSurat = JenisSurat::all();

        return view(
            'admin.pengajuan-masuk',
            compact('pengajuan', 'jenisSurat')
        );
    }

    public function verifikasi($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);

        if ($pengajuan->status != 'menunggu_verifikasi') {
            return back()->with(
                'error',
                'Pengajuan sudah diproses.'
            );
        }

        $pengajuan->update([
            'status' => 'diverifikasi_admin'
        ]);

        return back()->with(
            'success',
            'Pengajuan berhasil diverifikasi.'
        );
    }

    public function tolak(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'required'
        ]);

        $pengajuan = PengajuanSurat::findOrFail($id);

        if ($pengajuan->status != 'menunggu_verifikasi') {
            return back()->with(
                'error',
                'Pengajuan sudah diproses.'
            );
        }

        $pengajuan->update([
            'status' => 'ditolak_admin',
            'catatan_admin' => $request->catatan_admin,
        ]);

        return back()->with(
            'success',
            'Pengajuan ditolak.'
        );
    }    
}
