<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PersetujuanController extends Controller
{
    public function index()
    {
        $items = PengajuanSurat::with([
            'mahasiswa',
            'jenisSurat'
        ])
        ->where('status', 'diverifikasi_admin')
        ->latest('tanggal_verifikasi_admin')
        ->get();

        return view('kaprodi.persetujuan-pengajuan', compact('items'));
    }

  public function setujui(Request $request, PengajuanSurat $pengajuan)
    {
        $request->validate([
            'file_surat' => 'required|mimes:pdf|max:5120',
            'catatan_kaprodi' => 'nullable|string',
        ]);

        $path = $request->file('file_surat')->store('surat', 'public');

       $pengajuan->update([
            'status' => 'disetujui_kaprodi',
            'file_ttd' => $path,
            'catatan_kaprodi' => $request->catatan_kaprodi,
            'tanggal_keputusan_kaprodi' => now(),
        ]);

        return back()->with('success', 'Pengajuan berhasil disetujui.');
    }

    public function tolak(Request $request, PengajuanSurat $pengajuan)
    {
        $request->validate([
            'catatan_kaprodi' => 'required|string',
        ]);

        $pengajuan->update([
            'status' => 'ditolak_kaprodi',
            'catatan_kaprodi' => $request->catatan_kaprodi,
            'tanggal_keputusan_kaprodi' => now(),
        ]);

        return back()->with('success', 'Pengajuan berhasil ditolak.');
    }

    public function riwayat()
    {
        $items = PengajuanSurat::with(['mahasiswa', 'jenisSurat'])
            ->whereIn('status', [
                'disetujui_kaprodi',
                'ditolak_kaprodi',
            ])
            ->latest('tanggal_keputusan_kaprodi')
            ->get();

            $disetujui = $items->where('status', 'disetujui_kaprodi')->count();

            $ditolak = $items->where('status', 'ditolak_kaprodi')->count();

            return view('kaprodi.riwayat', compact(
                'items',
                'disetujui',
                'ditolak'
            ));
    }

}
