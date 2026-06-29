@extends('layouts.mahasiswa')

@section('title', 'Status Pengajuan - Portal Mahasiswa')
@section('page-title', 'Status Pengajuan')

@php
    $activeMenu = 'status';
@endphp

@section('content')
    <div
    x-data="{
            search: '',
            status: '',
            items: @js($pengajuans),

            get filteredItems() {
                const keyword = this.search.toLowerCase();

                return this.items.filter(item => {
                    const matchSearch =
                        item.jenis_surat.nama_surat.toLowerCase().includes(keyword);

                    const matchStatus =
                        this.status === '' ||
                        item.status === this.status;

                    return matchSearch && matchStatus;
                });
            }
        }"
    >

    

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
            'diverifikasi_admin',
            'disetujui_kaprodi',
            'ditolak_kaprodi'
        ]);

        $step3 = in_array($pengajuan->status, [
            'disetujui_kaprodi',
            'ditolak_admin',
            'ditolak_kaprodi'
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

            @if($pengajuan->status == 'diverifikasi_admin')
                <span class="rounded-full border border-blue-300 bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                    ● Diverifikasi Admin
                </span>
            @endif

            @if($pengajuan->status == 'disetujui_kaprodi')
                <span class="rounded-full border border-green-300 bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">
                    ● Disetujui Kaprodi
                </span>
            @endif

            @if($pengajuan->status == 'ditolak_admin')
                <span class="rounded-full border border-red-300 bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">
                    ● Ditolak Admin
                </span>
            @endif

            @if($pengajuan->status == 'ditolak_kaprodi')
                <span class="rounded-full border border-red-300 bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">
                    ● Ditolak Kaprodi
                </span>
            @endif
        </div>

        <div class="px-5 py-8">
            {{-- status pengajuan --}}
            <div class="rounded-2xl p-4 
                @if($pengajuan->status == 'menunggu_verifikasi')
                    border border-yellow-100 bg-yellow-50
                @elseif($pengajuan->status == 'diverifikasi_admin')
                    border border-blue-100 bg-blue-50
                @elseif($pengajuan->status == 'disetujui_kaprodi')
                    border border-green-100 bg-green-50
                @elseif(
                    $pengajuan->status == 'ditolak_admin' ||
                    $pengajuan->status == 'ditolak_kaprodi'
                )
                    border border-red-100 bg-red-50
                @endif">

                @if($pengajuan->status == 'menunggu_verifikasi')
                    <h4 class="font-semibold text-yellow-700">
                        Menunggu Verifikasi
                    </h4>

                    <p class="mt-1 text-sm text-yellow-600">
                        Admin TU sedang memeriksa kelengkapan dokumen.
                    </p>
                @endif

                @if($pengajuan->status == 'diverifikasi_admin')
                    <h4 class="font-semibold text-blue-700">
                        Diverifikasi Admin
                    </h4>

                    <p class="mt-1 text-sm text-blue-600">
                        Dokumen telah diverifikasi dan menunggu keputusan Kaprodi.
                    </p>
                @endif

                @if($pengajuan->status == 'disetujui_kaprodi')
                    <h4 class="font-semibold text-green-700">
                        Pengajuan Disetujui
                    </h4>

                    <p class="mt-1 text-sm text-green-600">
                        Surat telah disetujui oleh Kaprodi.
                    </p>
                @endif

                @if($pengajuan->status == 'ditolak_admin')
                    <h4 class="font-semibold text-red-700">
                        Ditolak Admin TU
                    </h4>
                @endif

                @if($pengajuan->status == 'ditolak_kaprodi')
                    <h4 class="font-semibold text-red-700">
                        Ditolak Kaprodi
                    </h4>

                    <p class="mt-1 text-sm text-red-600">
                        Pengajuan ditolak oleh Kaprodi.
                    </p>
                @endif

            </div>

            {{-- catatan admin --}}
            @if($pengajuan->catatan_admin)
                <div class="mt-4 rounded-xl bg-red-50 p-4">
                    <p class="font-semibold text-red-700">
                        Catatan Admin TU
                    </p>

                    <p class="mt-1 text-sm text-red-600">
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