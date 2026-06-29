@extends('layouts.mahasiswa')

@section('title', 'Dashboard Mahasiswa - SIERA')
@section('page-title', 'Dashboard')

@php
    $activeMenu = 'dashboard';

    $announcements = [
        ['title' => 'Jadwal Ujian Akhir Semester (UAS) Genap 2024/2025', 'desc' => 'UAS semester genap akan dilaksanakan pada tanggal 9-20 Juni 2025. Mahasiswa wajib hadir tepat waktu.', 'kategori' => 'Akademik'],
        ['title' => 'Pendaftaran Beasiswa Bidikmisi Tahap 2 Tahun 2025', 'desc' => 'Pendaftaran beasiswa Bidikmisi tahap 2 dibuka mulai 1 Juni 2025. Segera lengkapi berkas persyaratan.', 'kategori' => 'Beasiswa'],
        ['title' => 'Pengumuman Wisuda Periode Agustus 2025', 'desc' => 'Wisuda periode Agustus 2025 akan dilaksanakan pada 23 Agustus 2025. Pendaftaran dibuka mulai 1 Juli 2025.', 'kategori' => 'Akademik'],
    ];
@endphp

@section('content')
    <section class="mb-6 rounded-2xl bg-gradient-to-r from-cyan-600 to-blue-700 p-6 text-white shadow-sm">
        <p class="text-sm text-cyan-100">Selamat datang,</p>
        <h3 class="mt-1 text-2xl font-semibold">{{ auth()->user()->mahasiswa->nama }}</h3>
        <p class="mt-3 text-sm text-cyan-100">
            NIM: {{ auth()->user()->mahasiswa->nim }} <span class="mx-2">·</span> {{ auth()->user()->mahasiswa->prodi }}
        </p>
    </section>

    <section class="mb-6 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl border-2 border-blue-500 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total Pengajuan</p>
            <p class="mt-2 text-3xl font-semibold text-blue-600">
                {{ $totalPengajuan }}
            </p>
        </div>

        <div class="rounded-2xl border-2 border-amber-500 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Sedang Diproses</p>
            <p class="mt-2 text-3xl font-semibold text-amber-600">{{ $sedangDiproses }}</p>
        </div>

        <div class="rounded-2xl border-2 border-emerald-500 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Disetujui</p>
            <p class="mt-2 text-3xl font-semibold text-emerald-600">{{ $disetujui }}</p>
        </div>

        <div class="rounded-2xl border-2 border-red-500 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Ditolak</p>
            <p class="mt-2 text-3xl font-semibold text-red-600">{{ $ditolak }}</p>
        </div>
    </section>

    <section class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
            <h3 class="text-lg font-semibold text-slate-800">Pengajuan Aktif</h3>
            <a href="/mahasiswa/status" class="text-sm font-semibold text-cyan-600">
                Lihat semua ›
            </a>
        </div>

    @forelse($pengajuanAktif as $pengajuan)
        <div class="flex items-center justify-between px-5 py-4 border-b-0 last:border-b-0">
            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-100 text-cyan-600">
                    📄
                </div>

                <div>
                    <p class="font-semibold text-slate-700">
                        {{ $pengajuan->jenisSurat->nama_surat }}
                    </p>

                    <p class="text-sm text-slate-400">
                        {{ \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->translatedFormat('d F Y') }}
                    </p>
                </div>

            </div>

            @if($pengajuan->status == 'menunggu_verifikasi')

                <span class="rounded-full border border-amber-300 bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                    ● Menunggu Verifikasi
                </span>

            @elseif($pengajuan->status == 'diverifikasi_admin')

                <span class="rounded-full border border-blue-300 bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                    ● Diverifikasi Admin
                </span>

            @elseif($pengajuan->status == 'disetujui_kaprodi')

                <span class="rounded-full border border-green-300 bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">
                    ● Disetujui Kaprodi
                </span>

            @elseif($pengajuan->status == 'ditolak_admin')

                <span class="rounded-full border border-red-300 bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">
                    ● Ditolak Admin
                </span>

            @elseif($pengajuan->status == 'ditolak_kaprodi')

                <span class="rounded-full border border-red-300 bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">
                    ● Ditolak Kaprodi
                </span>

            @endif

        </div>

    @empty

        <div class="px-5 py-8 text-center text-slate-500">
            Belum ada pengajuan aktif.
        </div>

    @endforelse

</section>

    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
            <h3 class="text-lg font-semibold text-slate-800">Pengumuman Terbaru</h3>
            <a href="/mahasiswa/pengumuman" class="text-sm font-semibold text-cyan-600">Lihat semua ›</a>
        </div>

        <div class="divide-y divide-slate-100">
            @foreach ($announcements as $item)
                <div class="flex items-center justify-between gap-4 px-5 py-4">
                    <div class="flex min-w-0 items-center gap-3">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                            📣
                        </div>

                        <div class="min-w-0">
                            <p class="truncate font-semibold text-slate-700">{{ $item['title'] }}</p>
                            <p class="truncate text-sm text-slate-500">{{ $item['desc'] }}</p>
                        </div>
                    </div>

                    <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-600">
                        {{ $item['kategori'] }}
                    </span>
                </div>
            @endforeach
        </div>
    </section>
@endsection