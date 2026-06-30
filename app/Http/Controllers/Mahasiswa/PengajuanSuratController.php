<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisSurat;
use App\Models\PengajuanSurat;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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
            return back()->with(
                'error',
                'Jenis surat tidak tersedia.'
            );
        }

        $file = $request->file('file_pengajuan')
            ->store('pengajuan', 'public');

        PengajuanSurat::create([
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

    public function riwayat()
    {
        $pengajuans = PengajuanSurat::with('jenisSurat')
            ->where('mahasiswa_id', Auth::user()->mahasiswa->id)
            ->latest()
            ->get();

        $pengajuanData = $pengajuans->map(function ($item) {

            $tanggalKeputusan = null;

            if ($item->tanggal_keputusan_kaprodi) {
                $tanggalKeputusan =
                    Carbon::parse(
                        $item->tanggal_keputusan_kaprodi
                    )->translatedFormat('d F Y');
            } elseif ($item->tanggal_verifikasi_admin) {
                $tanggalKeputusan =
                    Carbon::parse(
                        $item->tanggal_verifikasi_admin
                    )->translatedFormat('d F Y');
            }

            return [
                'id' => $item->id,
                'jenis' => $item->jenisSurat->nama_surat ?? '-',
                'keperluan' => $item->keperluan,
                'tanggal' => Carbon::parse(
                    $item->tanggal_pengajuan
                )->translatedFormat('d F Y'),

                'status' => $item->status,

                'catatan' =>
                    $item->catatan_admin ??
                    $item->catatan_kaprodi ??
                    null,

                'penolak' => match ($item->status) {
                    'ditolak_admin' => 'Admin TU',
                    'ditolak_kaprodi' => 'Kaprodi',
                    default => null,
                },

                'file_pengajuan' => $item->file_pengajuan,
                'file_ttd' => $item->file_ttd,
                'tanggal_keputusan' => $item->updated_at
                ? Carbon::parse($item->updated_at)
                    ->translatedFormat('d F Y')
                : null,
            ];
        });

        $mahasiswa = Auth::user()->mahasiswa;

        return view(
            'mahasiswa.riwayat',
            compact('pengajuanData', 'mahasiswa')
        );
    }

    public function downloadSurat(PengajuanSurat $pengajuan)
    {
        // Pastikan hanya pemilik pengajuan yang bisa mengunduh
        if ($pengajuan->mahasiswa_id !== auth()->user()->mahasiswa->id) {
            abort(403);
        }

        // Pastikan file sudah ada
        if (!$pengajuan->file_ttd || !Storage::disk('public')->exists($pengajuan->file_ttd)) {
            return back()->with('error', 'File surat belum tersedia.');
        }

        return Storage::disk('public')->download($pengajuan->file_ttd);
    }
}
