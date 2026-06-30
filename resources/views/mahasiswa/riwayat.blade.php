@extends('layouts.mahasiswa')

@section('title', 'Riwayat Pengajuan - Portal Mahasiswa')
@section('page-title', 'Riwayat Pengajuan')

@php
    $activeMenu = 'riwayat';


@endphp

@section('content')
<div
    x-data="{
        statusText(status) {
            return {
                menunggu_verifikasi: 'Menunggu Verifikasi',
                diverifikasi_admin: 'Diverifikasi Admin',
                ditolak_admin: 'Ditolak Admin',
                disetujui_kaprodi: 'Disetujui Kaprodi',
                ditolak_kaprodi: 'Ditolak Kaprodi'
            }[status] || status;
        },

        detailOpen: false,
        selectedItem: null,
        search: '',
        status: '',

        items: @js($pengajuanData),

        get filteredItems() {
            const keyword = this.search.toLowerCase();

            return this.items.filter((item) => {
                const matchSearch =
                    item.jenis.toLowerCase().includes(keyword) ||
                    item.keperluan.toLowerCase().includes(keyword);

                const matchStatus =
                    this.status === '' || item.status === this.status;

                return matchSearch && matchStatus;
            });
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
    <div class="mb-5 grid gap-3 sm:grid-cols-[220px_1fr]">
        <select
            x-model="status"
            class="h-11 rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-500 outline-none"
        >
            <option value="">Semua Status</option>
            <option value="menunggu_verifikasi">Menunggu Verifikasi</option>
            <option value="diverifikasi_admin">Diverifikasi Admin</option>
            <option value="ditolak_admin">Ditolak Admin</option>
            <option value="disetujui_kaprodi">Disetujui Kaprodi</option>
            <option value="ditolak_kaprodi">Ditolak Kaprodi</option>
        </select>

        <div class="relative">
            <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">⌕</span>
            <input
                type="text"
                x-model="search"
                placeholder="Cari pengajuan..."
                class="h-11 w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-sm outline-none focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100"
            >
        </div>
    </div>

    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[1000px] text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-500">
                    <tr>
                        <th class="px-5 py-4">Jenis Surat</th>
                        <th class="px-5 py-4">Keperluan</th>
                        <th class="px-5 py-4">Tanggal</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4">Catatan</th>
                        <th class="px-5 py-4">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    <template x-for="item in filteredItems" :key="item.id">
                        <tr>
                            <td class="px-5 py-4 font-medium text-slate-700">
                                📄 <span x-text="item.jenis"></span>
                            </td>

                            <td class="px-5 py-4 text-slate-600" x-text="item.keperluan"></td>
                            <td class="px-5 py-4 text-slate-600" x-text="item.tanggal"></td>

                            <td class="px-5 py-4">
                                <span
                                    class="inline-flex items-center gap-1 rounded-full border px-3 py-1 text-xs font-semibold"
                                    :class="{
                                        'border-amber-300 bg-amber-50 text-amber-700':
                                            item.status === 'menunggu_verifikasi',

                                        'border-blue-300 bg-blue-50 text-blue-700':
                                            item.status === 'diverifikasi_admin',

                                        'border-emerald-300 bg-emerald-50 text-emerald-700':
                                            item.status === 'disetujui_kaprodi',

                                        'border-red-300 bg-red-50 text-red-700':
                                            item.status === 'ditolak_admin' ||
                                            item.status === 'ditolak_kaprodi'
                                    }"
                                >
                                    <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                    <span x-text="statusText(item.status)"></span>
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <span
                                    :class="{
                                        'text-slate-400': item.catatan === '—',
                                        'text-red-500': item.catatan !== '—'
                                    }"
                                    x-text="item.catatan"
                                ></span>
                            </td>

                            <td class="px-5 py-4">
                                <button
                                    type="button"
                                    @click="openDetail(item)"
                                    class="rounded-xl border border-cyan-200 px-4 py-2 text-sm font-semibold text-cyan-600 cursor-pointer"
                                >
                                    ⊙ Lihat Detail
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </section>

    {{-- Modal Detail Riwayat --}}
    <div
        x-show="detailOpen"
        x-transition.opacity
        class="fixed inset-0 z-[60] flex items-center justify-center bg-slate-900/50 px-4 py-6"
        style="display: none;"
    >
        <div
            @click.outside="closeDetail()"
            x-transition.scale.origin.center
            class="max-h-[92vh] w-full max-w-xl overflow-y-auto rounded-2xl bg-white shadow-2xl"
        >
            {{-- Header --}}
            <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
                <h3 class="text-xl font-semibold text-slate-800">
                    Detail Pengajuan
                </h3>

                <button
                    type="button"
                    @click="closeDetail()"
                    class="text-2xl leading-none text-slate-400 hover:text-slate-600"
                >
                    &times;
                </button>
            </div>

            {{-- Body --}}
            <div class="space-y-5 p-5" x-show="selectedItem">
                {{-- Status --}}
                <div class="flex items-center justify-between gap-4">
                    <span class="text-sm font-medium text-slate-500">
                        Status Akhir
                    </span>

                    <span
                        class="inline-flex items-center gap-1 rounded-full border px-3 py-1 text-xs font-semibold"
                        :class="{
                            'border-amber-300 bg-amber-50 text-amber-700':
                                selectedItem?.status === 'menunggu_verifikasi',

                            'border-blue-300 bg-blue-50 text-blue-700':
                                selectedItem?.status === 'diverifikasi_admin',

                            'border-emerald-300 bg-emerald-50 text-emerald-700':
                                selectedItem?.status === 'disetujui_kaprodi',

                            'border-red-300 bg-red-50 text-red-700':
                                selectedItem?.status === 'ditolak_admin' ||
                                selectedItem?.status === 'ditolak_kaprodi'
                        }"
                    >
                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                        <span x-text="statusText(selectedItem?.status)"></span>
                    </span>
                </div>

                {{-- Informasi Surat --}}
                <div class="rounded-2xl bg-slate-50 p-4">
                    <div class="space-y-4 text-sm">
                        <div>
                            <p class="text-slate-400">Jenis Surat</p>
                            <p class="font-semibold text-slate-700" x-text="selectedItem?.jenis"></p>
                        </div>

                        <div>
                            <p class="text-slate-400">Keperluan</p>
                            <p class="font-semibold text-slate-700" x-text="selectedItem?.keperluan"></p>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <p class="text-slate-400">Tanggal Pengajuan</p>
                                <p class="font-semibold text-slate-700" x-text="selectedItem?.tanggal"></p>
                            </div>

                            <template x-if="selectedItem?.tanggal_keputusan">
                                <div>
                                    <p class="text-slate-400">Tanggal Keputusan</p>
                                    <p class="font-semibold text-slate-700" x-text="selectedItem?.tanggal_keputusan"></p>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                {{-- Data Mahasiswa --}}
                <div>
                    <p class="mb-3 text-sm font-semibold text-slate-500">
                        Data Mahasiswa
                    </p>

                    <div class="rounded-2xl bg-slate-50 p-4">
                        <div class="grid gap-4 text-sm sm:grid-cols-2">
                            <div>
                                <p class="text-slate-400">Nama</p>
                                <p class="font-semibold text-slate-700">{{ $mahasiswa->nama }}</p>
                            </div>

                            <div>
                                <p class="text-slate-400">NIM</p>
                                <p class="font-semibold text-slate-700">{{ $mahasiswa->nim }}</p>
                            </div>

                            <div>
                                <p class="text-slate-400">Program Studi</p>
                                <p class="font-semibold text-slate-700">{{ $mahasiswa->prodi }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- File Surat Pengajuan --}}
                <div>
                    <h4 class="mb-3 text-sm font-semibold text-slate-500">
                        File Surat Pengajuan
                    </h4>

                    <div class="flex items-center justify-between rounded-xl border border-cyan-200 bg-cyan-50 px-4 py-3">
                        <div class="flex min-w-0 items-center gap-3">
                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white text-cyan-600">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                    <path
                                        d="M14 2V8H20"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </div>

                            <p class="truncate font-semibold text-slate-700" x-text="selectedItem?.file_pengajuan"></p>
                        </div>

                        <a
                            :href="'/storage/' + selectedItem?.file_pengajuan"
                            target="_blank"
                            class="ml-3 inline-flex shrink-0 items-center gap-1 rounded-lg border border-cyan-200 bg-white px-3 py-1.5 text-xs font-semibold text-cyan-600 hover:bg-cyan-50"
                        >
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M2 12C2 12 5.5 5 12 5C18.5 5 22 12 22 12C22 12 18.5 19 12 19C5.5 19 2 12 2 12Z"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                            Lihat
                        </a>
                    </div>
                </div>

                {{-- Dokumen Surat TTD Kaprodi --}}
                <template x-if="
                    selectedItem?.status === 'disetujui_kaprodi'
                    && selectedItem?.file_ttd
                ">
                    <div>
                        <h4 class="mb-3 text-sm font-semibold text-slate-500">
                            Dokumen Surat yang Telah Ditandatangani Kaprodi
                        </h4>

                        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4">
                            <div class="mb-3 flex items-start gap-3">
                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white text-emerald-600">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                </div>

                                <div class="min-w-0">
                                    <p class="font-semibold text-emerald-700">
                                        Surat sudah disetujui dan ditandatangani
                                    </p>
                                    <p class="mt-1 text-sm text-emerald-600">
                                        Dokumen resmi dapat diunduh dan digunakan untuk keperluan administrasi.
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-col gap-3 rounded-xl border border-emerald-200 bg-white px-4 py-3 sm:flex-row sm:items-center sm:justify-between">
                                <div class="flex min-w-0 items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-xs font-bold text-emerald-600">
                                        PDF
                                    </div>

                                    <div class="min-w-0">
                                        <p class="truncate font-semibold text-slate-700" x-text="selectedItem?.file_ttd"></p>
                                        <p class="text-xs text-slate-400">
                                            Dokumen final bertanda tangan Kaprodi
                                        </p>
                                    </div>
                                </div>

                                <div class="flex shrink-0 items-center gap-2">
                                    <a
                                        :href="'/storage/' + selectedItem?.file_ttd"
                                        target="_blank"
                                        class="inline-flex items-center justify-center gap-1 rounded-lg border border-emerald-200 bg-white px-3 py-2 text-xs font-semibold text-emerald-600 transition hover:bg-emerald-50"
                                    >
                                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M2 12C2 12 5.5 5 12 5C18.5 5 22 12 22 12C22 12 18.5 19 12 19C5.5 19 2 12 2 12Z"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />
                                            <path
                                                d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />
                                        </svg>
                                        Lihat
                                    </a>

                                    <a
                                        :href="'/storage/' + selectedItem?.file_ttd"                                        download
                                        class="inline-flex items-center justify-center gap-1 rounded-lg bg-emerald-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-emerald-700"
                                    >
                                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M12 3V15M12 15L7 10M12 15L17 10M5 21H19"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />
                                        </svg>
                                        Download Surat TTD
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                {{-- Alasan Penolakan --}}
                <template x-if="
                    (selectedItem?.status === 'ditolak_admin' ||
                    selectedItem?.status === 'ditolak_kaprodi')
                    &&
                    selectedItem?.catatan
                ">
                    <div class="rounded-2xl border border-red-200 bg-red-50 p-4">
                        <div class="mb-2 flex items-center gap-2 text-sm font-semibold text-red-600">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M12 9V13M12 17H12.01M10.29 3.86L1.82 18C1.43 18.67 1.91 19.5 2.68 19.5H21.32C22.09 19.5 22.57 18.67 22.18 18L13.71 3.86C13.32 3.2 10.68 3.2 10.29 3.86Z"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>

                            Alasan Penolakan dari Admin TU
                        </div>

                        <p
                            class="text-sm leading-6 text-red-600"
                            x-text="selectedItem?.catatan"
                        ></p>
                    </div>
                </template>

                {{-- Footer --}}
                <div class="border-t border-slate-100 pt-4">
                    <button
                        type="button"
                        @click="closeDetail()"
                        class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                    >
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
