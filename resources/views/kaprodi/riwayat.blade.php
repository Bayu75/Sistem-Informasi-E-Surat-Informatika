@extends('layouts.kaprodi')

@section('title', 'Riwayat Keputusan - Kaprodi')
@section('page-title', 'Riwayat Keputusan')

@php
    $activeMenu = 'riwayat';

@endphp

@section('content')
<div
    x-data="{
        search: '',
        detailOpen: false,
        selectedItem: null,
        items: @js(
            $items->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama' => $item->mahasiswa->nama,
                    'nim' => $item->mahasiswa->nim,
                    'prodi' => $item->mahasiswa->prodi,
                    'jenis' => $item->jenisSurat->nama_surat,
                    'keperluan' => $item->keperluan,
                    'tanggal' => optional($item->tanggal_keputusan_kaprodi)->format('d M Y'),
                    'status' => $item->status,
                    'catatan_admin' => $item->catatan_admin,
                    'catatan_kaprodi' => $item->catatan_kaprodi,
                    'file_surat' => $item->file_pengajuan,
                ];
            })
        ),

        get filteredItems() {
            const keyword = this.search.toLowerCase();
            return this.items.filter(item =>
                item.nama.toLowerCase().includes(keyword) ||
                item.nim.toLowerCase().includes(keyword) ||
                item.jenis.toLowerCase().includes(keyword)
            );
        },

        openDetail(item) {
            this.selectedItem = item;
            this.detailOpen = true;
        },

        closeDetail() {
            this.detailOpen = false;
            this.selectedItem = null;
        }
    }"
>
    <section class="mb-5 grid gap-4 md:grid-cols-2">
        <div class="rounded-2xl border border-emerald-300 bg-emerald-50 p-5">
            <p class="mt-2 text-3xl font-semibold text-emerald-600">
                {{ $disetujui }}
            </p>
        </div>

        <div class="rounded-2xl border border-red-300 bg-red-50 p-5">
            <p class="mt-2 text-3xl font-semibold text-red-600">
                {{ $ditolak }}
            </p>
        </div>
    </section>

    <div class="mb-5">
        <div class="relative">
            <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">⌕</span>
            <input
                x-model="search"
                type="text"
                placeholder="Cari riwayat keputusan..."
                class="h-11 w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-sm outline-none focus:border-violet-500 focus:ring-4 focus:ring-violet-100"
            >
        </div>
    </div>

    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[1000px] text-left text-sm">
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

                <tbody class="divide-y divide-slate-100">
                    <template x-for="item in filteredItems" :key="item.id">
                        <tr>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-violet-100 text-xs font-bold text-violet-600" x-text="item.nama.charAt(0)"></span>
                                    <span x-text="item.nama"></span>
                                </div>
                            </td>
                            <td class="px-5 py-4" x-text="item.nim"></td>
                            <td class="px-5 py-4" x-text="item.jenis"></td>
                            <td class="px-5 py-4" x-text="item.tanggal"></td>
                            <td class="px-5 py-4">
                                <div class="space-y-1">
                                    <span
                                        class="inline-flex items-center gap-1 rounded-full border px-3 py-1 text-xs font-semibold"
                                        :class="{
                                            'border-emerald-300 bg-emerald-50 text-emerald-700': item.status === 'Disetujui',
                                            'border-red-300 bg-red-50 text-red-700': item.status === 'Ditolak'
                                        }"
                                    >
                                        ●<span
                                            x-text="item.status === 'disetujui_kaprodi'
                                            ? 'Disetujui'
                                            : 'Ditolak'">
                                        </span>
                                    </span>

                                    <template x-if="item.kadaluwarsa">
                                        <span
                                            class="block w-fit rounded-full px-3 py-1 text-xs font-semibold"
                                            :class="{
                                                'bg-emerald-100 text-emerald-700': item.kadaluwarsa === 'Aktif',
                                                'bg-red-100 text-red-700': item.kadaluwarsa === 'Kadaluwarsa'
                                            }"
                                        >
                                            ● <span x-text="item.kadaluwarsa"></span>
                                        </span>
                                    </template>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <button @click="openDetail(item)" class="font-semibold text-violet-600">⊙ Detail</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </section>

    {{-- Modal Detail --}}
    <div
        x-show="detailOpen"
        x-transition.opacity
        class="fixed inset-0 z-[60] flex items-center justify-center bg-slate-900/50 px-4 py-6"
        style="display: none;"
    >
        <div @click.outside="closeDetail()" class="max-h-[92vh] w-full max-w-2xl overflow-y-auto rounded-2xl bg-white shadow-2xl">
            <div class="flex items-start justify-between border-b border-slate-100 px-5 py-4">
                <div>
                    <h3 class="text-xl font-semibold text-slate-800">Detail Pengajuan Surat</h3>
                    <p class="text-sm text-slate-400">ID: <span x-text="selectedItem?.id"></span></p>
                </div>
                <button @click="closeDetail()" class="text-2xl text-slate-400">&times;</button>
            </div>

            <div class="space-y-4 p-5" x-show="selectedItem">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-500">Status saat ini:</span>
                    <span
                        class="rounded-full border px-3 py-1 text-xs font-semibold"
                        :class="{
                            'border-emerald-300 bg-emerald-50 text-emerald-700': item.status === 'disetujui_kaprodi',
                            'border-red-300 bg-red-50 text-red-700': item.status === 'ditolak_kaprodi'
                        }"
                    >
                        ● <span x-text="selectedItem?.status"></span>
                    </span>
                </div>

                <div class="rounded-2xl bg-slate-50 p-4">
                    <h4 class="mb-4 font-semibold text-slate-700">Informasi Mahasiswa</h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between"><span class="text-slate-500">Nama</span><b x-text="selectedItem?.nama"></b></div>
                        <div class="flex justify-between"><span class="text-slate-500">NIM</span><b x-text="selectedItem?.nim"></b></div>
                        <div class="flex justify-between"><span class="text-slate-500">Program Studi</span><b>Teknik Informatika</b></div>
                    </div>
                </div>

                <div class="rounded-2xl bg-slate-50 p-4">
                    <h4 class="mb-4 font-semibold text-slate-700">Informasi Surat</h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between gap-4"><span class="text-slate-500">Jenis Surat</span><b class="text-right" x-text="selectedItem?.jenis"></b></div>
                        <div class="flex justify-between gap-4"><span class="text-slate-500">Keperluan</span><b class="max-w-sm text-right" x-text="selectedItem?.keperluan"></b></div>
                        <div class="flex justify-between gap-4"><span class="text-slate-500">Tanggal Pengajuan</span><b x-text="selectedItem?.tanggal"></b></div>
                    </div>
                </div>

                <div>
                    <h4 class="mb-3 text-sm font-semibold text-slate-700">File Surat Pengajuan</h4>
                    <div class="flex items-center justify-between rounded-xl border border-violet-200 bg-violet-50 px-4 py-3">
                        <p class="font-semibold text-slate-700" x-text="selectedItem?.file_surat"></p>
                        <div class="flex gap-3 text-xs font-semibold">
                            <a href="#" class="text-violet-600">Lihat</a>
                            <a href="#" class="text-slate-500">Unduh</a>
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="mb-3 text-sm font-semibold text-slate-700">Dokumen Pendukung yang Dilampirkan</h4>
                    <div class="space-y-2">
                        <template x-for="dokumen in selectedItem?.dokumen" :key="dokumen">
                            <div class="flex items-center justify-between rounded-xl border border-slate-200 px-4 py-3">
                                <span x-text="dokumen"></span>
                                <a href="#" class="text-xs font-semibold text-violet-600">Lihat</a>
                            </div>
                        </template>
                    </div>
                </div>

                <button @click="closeDetail()" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
