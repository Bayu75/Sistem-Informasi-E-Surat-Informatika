@extends('layouts.kaprodi')

@section('title', 'Dashboard Kaprodi - SIERA')
@section('page-title', 'Dashboard')

@php
    $activeMenu = 'dashboard';

    $pending = [
        'id' => 'S3',
        'nama' => 'Rizky Pratama',
        'nim' => '2020015',
        'jenis' => 'Surat Permohonan Beasiswa',
        'tanggal' => '15 Mei 2025',
        'status' => 'Diteruskan ke Kaprodi',
    ];

    $pengumuman = [
        ['title' => 'Jadwal Ujian Akhir Semester (UAS) Genap 2024/2025', 'desc' => 'UAS semester genap akan dilaksanakan pada tanggal 9-20 Juni 2025. Mahasiswa wajib hadir tepat waktu.', 'kategori' => 'Akademik'],
        ['title' => 'Pendaftaran Beasiswa Bidikmisi Tahap 2 Tahun 2025', 'desc' => 'Pendaftaran beasiswa Bidikmisi tahap 2 dibuka mulai 1 Juni 2025. Segera lengkapi berkas persyaratan.', 'kategori' => 'Beasiswa'],
    ];
@endphp

@section('content')
<div>
    <section class="mb-6 rounded-2xl bg-gradient-to-r from-violet-600 to-indigo-700 p-6 text-white shadow-sm">
        <p class="text-sm text-violet-100">Selamat datang,</p>
        <h3 class="mt-1 text-2xl font-semibold">{{ auth()->user()->kaprodi->nama }}</h3>
        <p class="mt-2 text-sm text-violet-100">
            Terdapat <span class="font-semibold text-white">1 pengajuan</span> yang menunggu keputusan Anda.
        </p>
    </section>

    <section class="mb-6 grid gap-4 lg:grid-cols-3">
        <div class="rounded-2xl border-2 border-amber-500 bg-white p-5 shadow-sm">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm text-slate-500">Menunggu Keputusan</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-800">1</p>
                    <p class="mt-2 text-sm text-slate-400">Diteruskan dari Admin TU</p>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600">◷</div>
            </div>
        </div>

        <div class="rounded-2xl border-2 border-emerald-500 bg-white p-5 shadow-sm">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm text-slate-500">Pengajuan Disetujui</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-800">2</p>
                    <p class="mt-2 text-sm text-slate-400">Total disetujui</p>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">👍</div>
            </div>
        </div>

        <div class="rounded-2xl border-2 border-red-500 bg-white p-5 shadow-sm">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm text-slate-500">Pengajuan Ditolak</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-800">2</p>
                    <p class="mt-2 text-sm text-slate-400">Total ditolak</p>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-50 text-red-600">👎</div>
            </div>
        </div>
    </section>

    <section class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
            <h3 class="text-lg font-semibold text-slate-800">Pengajuan Menunggu Keputusan</h3>
            <a href="/kaprodi/persetujuan-pengajuan" class="text-sm font-semibold text-violet-600">Proses ›</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-500">
                    <tr>
                        <th class="px-5 py-4">Mahasiswa</th>
                        <th class="px-5 py-4">NIM</th>
                        <th class="px-5 py-4">Jenis Surat</th>
                        <th class="px-5 py-4">Tanggal</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t border-slate-100">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-violet-100 text-xs font-bold text-violet-600">R</span>
                                Rizky Pratama
                            </div>
                        </td>
                        <td class="px-5 py-4">2020015</td>
                        <td class="px-5 py-4">Surat Permohonan Beasiswa</td>
                        <td class="px-5 py-4">15 Mei 2025</td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1 rounded-full border border-violet-300 bg-violet-50 px-3 py-1 text-xs font-semibold text-violet-700">
                                ● Diteruskan ke Kaprodi
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <a href="/kaprodi/persetujuan-pengajuan" class="font-semibold text-violet-600">⊙ Detail</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
            <h3 class="text-lg font-semibold text-slate-800">Pengumuman Terbaru</h3>
            <a href="/kaprodi/pengumuman" class="text-sm font-semibold text-violet-600">Lihat semua ›</a>
        </div>

        <div class="divide-y divide-slate-100">
            @foreach ($pengumuman as $item)
                <div class="flex items-center justify-between gap-4 px-5 py-4">
                    <div class="flex min-w-0 items-center gap-3">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-violet-100 text-violet-600">📣</div>
                        <div class="min-w-0">
                            <p class="truncate font-semibold text-slate-700">{{ $item['title'] }}</p>
                            <p class="truncate text-sm text-slate-500">{{ $item['desc'] }}</p>
                        </div>
                    </div>

                    <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $item['kategori'] === 'Beasiswa' ? 'bg-purple-100 text-purple-600' : 'bg-blue-100 text-blue-600' }}">
                        {{ $item['kategori'] }}
                    </span>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection