<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class PengumumanController extends Controller
{
    public function index()
    {
       $pengumuman = Pengumuman::with('creator.adminTU')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.pengumuman', compact('pengumuman'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'judul' => 'required',
        'kategori' => 'required',
        'tanggal' => 'required|date',
        'ringkasan' => 'required',
        'isi' => 'nullable',
        'file' => 'required|mimes:pdf|max:10240',
    ]);

        $filePath = null;
        $namaFileAsli = null;

        if ($request->hasFile('file')) {

            $file = $request->file('file');

            $namaFileAsli = $file->getClientOriginalName();

            $namaFileServer = time() . '_' . $namaFileAsli;

            $filePath = $file->storeAs(
                'pengumuman',
                $namaFileServer,
                'public'
            );
        }

    Pengumuman::create([
        'judul' => $validated['judul'],
        'kategori' => $validated['kategori'],
        'ringkasan' => $validated['ringkasan'],
        'isi' => $validated['isi'],
        'file' => $filePath,
        'nama_file_asli' => $namaFileAsli,
        'tanggal' => $validated['tanggal'],
        'status' => 'Aktif',
        'created_by' => Auth::id(),
    ]);

    return redirect('/admin/pengumuman')
        ->with('success', 'Pengumuman berhasil ditambahkan.');
}

public function destroy(Pengumuman $pengumuman)
{
    if ($pengumuman->file) {
        Storage::disk('public')->delete($pengumuman->file);
    }

    $pengumuman->delete();
    return redirect('/admin/pengumuman')
        ->with('success', 'Pengumuman berhasil dihapus.');
}

public function lihat(Pengumuman $pengumuman)
{
    $path = storage_path('app/public/' . $pengumuman->file);

    return response()->file($path);
}

public function download(Pengumuman $pengumuman)
{
    $path = storage_path('app/public/' . $pengumuman->file);

    return response()->download(
        $path,
        $pengumuman->nama_file_asli
    );
}

}
