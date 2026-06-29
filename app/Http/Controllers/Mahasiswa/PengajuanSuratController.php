<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisSurat;
use App\Models\PengajuanSurat;
use Illuminate\Support\Facades\Auth;

class PengajuanSuratController extends Controller
{
    public function index()
    {
        return view('mahasiswa.pengajuan.index');
    }

    public function create()
    {
        $jenisSurat = JenisSurat::where('aktif', 1)->get();

        return view('mahasiswa.ajukan', compact('jenisSurat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat_id' => 'required|exists:jenis_surat,id',
            'keperluan' => 'required',
            'file_pengajuan' => 'required|mimes:pdf,doc,docx|max:5120',
        ]);

        $surat = JenisSurat::where('id', $request->jenis_surat_id)
                            ->where('aktif', 1)
                            ->first();

        if (!$surat) {
            return back()->with('error', 'Jenis surat tidak tersedia.');
        }

        $file = $request->file('file_pengajuan')
                        ->store('pengajuan', 'public');

        $pengajuan = PengajuanSurat::create([
            'mahasiswa_id' => Auth::user()->mahasiswa->id,
            'jenis_surat_id' => $request->jenis_surat_id,
            'keperluan' => $request->keperluan,
            'file_pengajuan' => $file,
            'status' => 'menunggu_verifikasi',
            'tanggal_pengajuan' => now(),
        ]);

        return redirect()
                ->back()
                ->with('success', 'Pengajuan berhasil dikirim.');
    }

    public function status()
    {
        $pengajuans = PengajuanSurat::with([
                'jenisSurat',
            ])
            ->where(
                'mahasiswa_id',
                Auth::user()->mahasiswa->id
            )
            ->latest()
            ->get();

        return view(
            'mahasiswa.status',
            compact('pengajuans')
        );
    }

    public function downloadTemplate($id)
    {
        $surat = JenisSurat::findOrFail($id);

        $path = storage_path(
            'app/public/templates/' .
            $surat->template_file
        );

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->download($path);
    }
}
