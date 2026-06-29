@extends('layouts.mahasiswa')

@section('title', 'Status Pengajuan - Portal Mahasiswa')
@section('page-title', 'Status Pengajuan')

@php
    $activeMenu = 'status';
@endphp

@section('content')
    <div class="mb-5 grid gap-3 sm:grid-cols-[220px_1fr]">
        <select class="h-11 rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-500 outline-none">
            <option>Semua Status</option>
            <option>Menunggu Verifikasi</option>
            <option>Diproses Kaprodi</option>
            <option>Disetujui</option>
            <option>Ditolak</option>
        </select>

        <div class="relative">
            <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">⌕</span>
            <input
                type="text"
                placeholder="Cari pengajuan..."
                class="h-11 w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-sm outline-none focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100"
            >
        </div>
    </div>

    @if($pengajuans->isEmpty())
        <div class="rounded-2xl border border-slate-200 bg-white p-8 text-center">
            <p class="text-slate-500">
                Belum ada pengajuan surat.
            </p>
        </div>
    @endif

    @foreach($pengajuans as $pengajuan)
    @php
        $step1 = true;

        $step2 = in_array($pengajuan->status, [
            'diteruskan_ke_kaprodi',
            'disetujui',
            'ditolak'
        ]);

        $step3 = in_array($pengajuan->status, [
            'disetujui',
            'ditolak'
        ]);
    @endphp

    <section class="mb-5 rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-5 py-4">
            <div>
                <h3 class="font-semibold text-slate-800">
                    {{ $pengajuan->jenisSurat->nama_surat }}
                </h3>
                <p class="mt-1 text-sm text-slate-400">
                    Diajukan:
                    {{ $pengajuan->created_at->format('d F Y') }}
                </p>
            </div>

            @if($pengajuan->status == 'menunggu_verifikasi')
                <span class="rounded-full border border-amber-300 bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                    ● Menunggu Verifikasi
                </span>
            @endif

            @if($pengajuan->status == 'diteruskan_ke_kaprodi')
                <span class="rounded-full border border-blue-300 bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                    ● Diproses Kaprodi
                </span>
            @endif

            @if($pengajuan->status == 'disetujui')
                <span class="rounded-full border border-green-300 bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">
                    ● Disetujui
                </span>
            @endif

            @if($pengajuan->status == 'ditolak')
                <span class="rounded-full border border-red-300 bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">
                    ● Ditolak
                </span>
            @endif
        </div>

        <div class="px-5 py-8">
            {{-- timeline --}}
            <div class="relative">
                <div class="absolute left-8 right-8 top-6 h-1 bg-slate-200"></div>

                <div class="relative grid grid-cols-3 gap-3 text-center">
                    <div>
                        <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full
                            {{ $step1
                                ? 'bg-cyan-500 text-white ring-4 ring-cyan-100'
                                : 'border border-slate-300 bg-white text-slate-400' }}">
                            ⏱
                        </div>
                        <p class="mt-3 text-sm font-semibold
                            {{ $step1 ? 'text-cyan-600' : 'text-slate-400' }}">
                            Menunggu<br>Verifikasi
                        </p>
                    </div>

                    <div>
                        <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full
                            {{ $step2
                                ? 'bg-cyan-500 text-white ring-4 ring-cyan-100'
                                : 'border border-slate-300 bg-white text-slate-400' }}">
                            ➤
                        </div>
                        <p class="mt-3 text-sm font-semibold
                            {{ $step2 ? 'text-cyan-600' : 'text-slate-400' }}">
                            Diproses<br>Kaprodi
                        </p>
                    </div>

                    <div>
                        <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full
                            {{ $step3
                                ? 'bg-cyan-500 text-white ring-4 ring-cyan-100'
                                : 'border border-slate-300 bg-white text-slate-400' }}">
                            ✓
                        </div>
                        <p class="mt-3 text-sm font-semibold
                            {{ $step3 ? 'text-cyan-600' : 'text-slate-400' }}">
                            Disetujui /<br>Ditolak
                        </p>
                    </div>
                </div>
            </div>

            {{-- status pengajuan --}}
            <div class="mt-8 rounded-2xl p-4
                @if($pengajuan->status == 'menunggu_verifikasi')
                    border border-cyan-100 bg-cyan-50
                @elseif($pengajuan->status == 'diteruskan_ke_kaprodi')
                    border border-blue-100 bg-blue-50
                @elseif($pengajuan->status == 'disetujui')
                    border border-green-100 bg-green-50
                @elseif($pengajuan->status == 'ditolak')
                    border border-red-100 bg-red-50
                @endif">

                @if($pengajuan->status == 'menunggu_verifikasi')
                    <h4 class="font-semibold text-cyan-700">
                        Menunggu Verifikasi
                    </h4>

                    <p class="mt-1 text-sm text-cyan-600">
                        Admin TU sedang memeriksa kelengkapan dokumen.
                    </p>
                @endif

                @if($pengajuan->status == 'diteruskan_ke_kaprodi')
                    <h4 class="font-semibold text-blue-700">
                        Diproses Kaprodi
                    </h4>

                    <p class="mt-1 text-sm text-blue-600">
                        Pengajuan sedang diproses oleh Kaprodi.
                    </p>
                @endif

                @if($pengajuan->status == 'disetujui')
                    <h4 class="font-semibold text-green-700">
                        Pengajuan Disetujui
                    </h4>

                    <p class="mt-1 text-sm text-green-600">
                        Surat telah disetujui dan dapat diambil.
                    </p>
                @endif

                @if($pengajuan->status == 'ditolak')
                    <h4 class="font-semibold text-red-700">
                        Pengajuan Ditolak
                    </h4>

                    <p class="mt-1 text-sm text-red-600">
                        Pengajuan ditolak oleh pihak program studi.
                    </p>
                @endif

            </div>

            {{-- catatan admin --}}
            @if($pengajuan->catatan_admin)
                <div class="mt-4 rounded-xl bg-yellow-50 p-4">
                    <p class="font-semibold text-yellow-700">
                        Catatan Admin TU
                    </p>

                    <p class="mt-1 text-sm text-yellow-600">
                        {{ $pengajuan->catatan_admin }}
                    </p>
                </div>
            @endif

            {{-- catatan kaprodi --}}
            @if($pengajuan->catatan_kaprodi)
                <div class="mt-4 rounded-xl bg-blue-50 p-4">
                    <p class="font-semibold text-blue-700">
                        Catatan Kaprodi
                    </p>

                    <p class="mt-1 text-sm text-blue-600">
                        {{ $pengajuan->catatan_kaprodi }}
                    </p>
                </div>
            @endif
        </div>
    </section>
    @endforeach
@endsection