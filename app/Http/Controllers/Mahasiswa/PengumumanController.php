<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index()
    {
    $pengumuman = Pengumuman::where('status', 'Aktif')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('mahasiswa.pengumuman', compact('pengumuman'));
    }

    public function lihat(Pengumuman $pengumuman)
    {
        if (!$pengumuman->file || !Storage::disk('public')->exists($pengumuman->file)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->file(
            storage_path('app/public/' . $pengumuman->file)
        );
    }

    public function download(Pengumuman $pengumuman)
    {
        if (!$pengumuman->file || !Storage::disk('public')->exists($pengumuman->file)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download(
            storage_path('app/public/' . $pengumuman->file),
            $pengumuman->nama_file_asli
        );
    }
}
