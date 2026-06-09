@extends('layouts.admin')

@section('title', 'Arsip Surat - Admin TU')
@section('page-title', 'Arsip Surat')

@php
    $activeMenu = 'arsip';

    $arsip = [
        [
            'no' => 'S4',
            'nama' => 'Anisa Putri',
            'nim' => '2020020',
            'jenis' => 'Surat Keterangan Aktif Kuliah',
            'tanggal' => '10 Mei 2025',
            'status' => 'Disetujui',
            'kadaluwarsa' => 'Aktif',
            'tanggal_kadaluwarsa' => '13 Agu 2026',
            'waktu' => 'bulan_ini',
            'urutan' => 4,
        ],
        [
            'no' => 'S1B',
            'nama' => 'Budi Santoso',
            'nim' => '2021001',
            'jenis' => 'Surat Dispensasi',
            'tanggal' => '10 Mei 2025',
            'status' => 'Ditolak',
            'kadaluwarsa' => '-',
            'tanggal_kadaluwarsa' => null,
            'waktu' => 'bulan_ini',
            'urutan' => 3,
        ],
        [
            'no' => 'S5',
            'nama' => 'Fauzan Malik',
            'nim' => '2021030',
            'jenis' => 'Surat Rekomendasi',
            'tanggal' => '8 Mei 2025',
            'status' => 'Ditolak',
            'kadaluwarsa' => '-',
            'tanggal_kadaluwarsa' => null,
            'waktu' => 'bulan_ini',
            'urutan' => 2,
        ],
        [
            'no' => 'S6',
            'nama' => 'Sari Wulandari',
            'nim' => '2019005',
            'jenis' => 'Surat Keterangan Lulus',
            'tanggal' => '25 Apr 2025',
            'status' => 'Disetujui',
            'kadaluwarsa' => 'Kadaluwarsa',
            'tanggal_kadaluwarsa' => '28 Okt 2025',
            'waktu' => 'bulan_ini',
            'urutan' => 1,
        ],
    ];
@endphp

@section('content')
<div
    x-data="{
        detailOpen: false,

        search: '',
        jenis: '',
        status: '',
        waktu: '',
        sort: 'terbaru',

        selectedItem: null,

        items: @js($arsip),

        get filteredItems() {
            let result = this.items.filter((item) => {
                const keyword = this.search.toLowerCase();

                const matchSearch =
                    item.no.toLowerCase().includes(keyword) ||
                    item.nama.toLowerCase().includes(keyword) ||
                    item.nim.toLowerCase().includes(keyword) ||
                    item.jenis.toLowerCase().includes(keyword);

                const matchJenis =
                    this.jenis === '' || item.jenis === this.jenis;

                const matchStatus =
                    this.status === '' || item.status === this.status;

                const matchWaktu =
                    this.waktu === '' || item.waktu === this.waktu;

                return matchSearch && matchJenis && matchStatus && matchWaktu;
            });

            if (this.sort === 'nama_az') {
                result.sort((a, b) => a.nama.localeCompare(b.nama));
            }

            if (this.sort === 'nama_za') {
                result.sort((a, b) => b.nama.localeCompare(a.nama));
            }

            if (this.sort === 'terbaru') {
                result.sort((a, b) => b.urutan - a.urutan);
            }

            if (this.sort === 'terlama') {
                result.sort((a, b) => a.urutan - b.urutan);
            }

            return result;
        },

        resetFilter() {
            this.search = '';
            this.jenis = '';
            this.status = '';
            this.waktu = '';
            this.sort = 'terbaru';
        },

        openDetail(item) {
            this.selectedItem = item;
            this.detailOpen = true;
        }
    }"
>
    {{-- Filter --}}
    <section class="mb-4 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
        <div class="grid gap-3 xl:grid-cols-[1fr_180px_160px_150px_150px_100px]">
            {{-- Search --}}
            <div class="relative">
                <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M21 21L16.65 16.65M18 11C18 14.866 14.866 18 11 18C7.13401 18 4 14.866 4 11C4 7.13401 7.13401 4 11 4C14.866 4 18 7.13401 18 11Z"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </span>

                <input
                    type="text"
                    x-model="search"
                    placeholder="Cari nama mahasiswa, NIM, atau nomor surat..."
                    class="h-11 w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-11 pr-4 text-sm text-slate-700 placeholder:text-slate-400 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                >
            </div>

            {{-- Jenis Surat --}}
            <select
                x-model="jenis"
                class="h-11 rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
            >
                <option value="">Semua Jenis Surat</option>
                <option value="Surat Keterangan Aktif Kuliah">Surat Keterangan Aktif Kuliah</option>
                <option value="Surat Dispensasi">Surat Dispensasi</option>
                <option value="Surat Rekomendasi">Surat Rekomendasi</option>
                <option value="Surat Keterangan Lulus">Surat Keterangan Lulus</option>
            </select>

            {{-- Status --}}
            <select
                x-model="status"
                class="h-11 rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
            >
                <option value="">Semua Status</option>
                <option value="Disetujui">Disetujui</option>
                <option value="Ditolak">Ditolak</option>
            </select>

            {{-- Waktu --}}
            <select
                x-model="waktu"
                class="h-11 rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
            >
                <option value="">Semua Waktu</option>
                <option value="hari_ini">Hari Ini</option>
                <option value="minggu_ini">Minggu Ini</option>
                <option value="bulan_ini">Bulan Ini</option>
            </select>

            {{-- Sort --}}
            <select
                x-model="sort"
                class="h-11 rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
            >
                <option value="terbaru">Terbaru Dulu</option>
                <option value="terlama">Terlama Dulu</option>
                <option value="nama_az">Nama A-Z</option>
                <option value="nama_za">Nama Z-A</option>
            </select>

            {{-- Reset --}}
            <button
                type="button"
                @click="resetFilter()"
                class="inline-flex h-11 items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 text-sm font-medium text-slate-400 transition hover:bg-slate-50 hover:text-slate-600"
            >
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M4 4V10H10M20 20V14H14M19 9A7 7 0 0 0 6.34 6.34L4 10M20 14L17.66 17.66A7 7 0 0 1 5 15"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
                Reset
            </button>
        </div>

        <div class="mt-3 border-t border-slate-100 pt-3">
            <p class="flex items-center gap-1 text-xs text-slate-500">
                <svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M4 6H20M6 6V20H18V6M9 10H15M9 14H15"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>

                Menampilkan
                <b x-text="filteredItems.length"></b>
                dari
                <b x-text="items.length"></b>
                arsip
            </p>
        </div>
    </section>

    {{-- Table --}}
    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[1100px] text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-500">
                    <tr>
                        <th class="px-5 py-4">No. Surat</th>
                        <th class="px-5 py-4">Mahasiswa</th>
                        <th class="px-5 py-4">NIM</th>
                        <th class="px-5 py-4">Jenis Surat</th>
                        <th class="px-5 py-4">Tgl Pengajuan</th>
                        <th class="px-5 py-4">Status Akhir</th>
                        <th class="px-5 py-4">Kadaluwarsa</th>
                        <th class="px-5 py-4">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    <template x-for="item in filteredItems" :key="item.no">
                        <tr class="transition hover:bg-slate-50/60">
                            <td class="px-5 py-4 font-medium text-slate-600" x-text="item.no"></td>

                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <span
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 text-xs font-bold text-blue-600"
                                        x-text="item.nama.charAt(0)"
                                    ></span>

                                    <span class="font-medium text-slate-700" x-text="item.nama"></span>
                                </div>
                            </td>

                            <td class="px-5 py-4 text-slate-600" x-text="item.nim"></td>

                            <td class="px-5 py-4 text-slate-600" x-text="item.jenis"></td>

                            <td class="px-5 py-4 text-slate-600" x-text="item.tanggal"></td>

                            <td class="px-5 py-4">
                                <span
                                    class="inline-flex items-center gap-1 rounded-full border px-3 py-1 text-xs font-semibold"
                                    :class="{
                                        'border-emerald-300 bg-emerald-50 text-emerald-700': item.status === 'Disetujui',
                                        'border-red-300 bg-red-50 text-red-700': item.status === 'Ditolak'
                                    }"
                                >
                                    <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                    <span x-text="item.status"></span>
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <template x-if="item.kadaluwarsa === '-'">
                                    <span class="text-slate-300">—</span>
                                </template>

                                <template x-if="item.kadaluwarsa !== '-'">
                                    <div>
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full border px-3 py-1 text-xs font-semibold"
                                            :class="{
                                                'border-emerald-300 bg-emerald-50 text-emerald-700': item.kadaluwarsa === 'Aktif',
                                                'border-red-300 bg-red-50 text-red-700': item.kadaluwarsa === 'Kadaluwarsa'
                                            }"
                                        >
                                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                            <span x-text="item.kadaluwarsa"></span>
                                        </span>

                                        <p
                                            class="mt-1 text-xs text-slate-400"
                                            x-text="item.tanggal_kadaluwarsa"
                                        ></p>
                                    </div>
                                </template>
                            </td>

                            <td class="px-5 py-4">
                                <button
                                    type="button"
                                    @click="openDetail(item)"
                                    class="inline-flex items-center gap-1 font-semibold text-blue-600 hover:text-blue-700 cursor-pointer"
                                >
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
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
                                    Detail
                                </button>
                            </td>
                        </tr>
                    </template>

                    <tr x-show="filteredItems.length === 0">
                        <td colspan="8" class="px-5 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M21 21L16.65 16.65M18 11C18 14.866 14.866 18 11 18C7.13401 18 4 14.866 4 11C4 7.13401 7.13401 4 11 4C14.866 4 18 7.13401 18 11Z"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-slate-500">
                                    Tidak ada data arsip yang sesuai dengan filter.
                                </p>
                                <button
                                    type="button"
                                    @click="resetFilter()"
                                    class="mt-2 text-sm font-semibold text-blue-600 hover:text-blue-700"
                                >
                                    Reset filter
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    {{-- Modal Detail Arsip --}}
    <div
        x-show="detailOpen"
        x-transition.opacity
        class="fixed inset-0 z-[60] flex items-center justify-center bg-slate-900/50 px-4 py-6"
        style="display: none;"
    >
        <div
            @click.outside="detailOpen = false"
            x-transition.scale.origin.center
            class="max-h-[92vh] w-full max-w-2xl overflow-y-auto rounded-2xl bg-white shadow-2xl"
        >
            {{-- Header Modal --}}
            <div class="flex items-start justify-between border-b border-slate-100 px-5 py-4">
                <div>
                    <h3 class="text-xl font-semibold text-slate-800">
                        Detail Pengajuan Surat
                    </h3>
                    <p class="mt-0.5 text-sm text-slate-400">
                        ID:
                        <span x-text="selectedItem?.no"></span>
                    </p>
                </div>

                <button
                    type="button"
                    @click="detailOpen = false"
                    class="text-2xl leading-none text-slate-400 hover:text-slate-600"
                >
                    &times;
                </button>
            </div>

            {{-- Body Modal --}}
            <div class="space-y-4 p-5" x-show="selectedItem">
                {{-- Status --}}
                <div>
                    <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                        <span class="text-sm font-medium text-slate-500">
                            Status saat ini:
                        </span>

                        <div class="flex flex-wrap items-center gap-2">
                            <span
                                class="inline-flex items-center gap-1 rounded-full border px-3 py-1 text-xs font-semibold"
                                :class="{
                                    'border-emerald-300 bg-emerald-50 text-emerald-700': selectedItem?.status === 'Disetujui',
                                    'border-red-300 bg-red-50 text-red-700': selectedItem?.status === 'Ditolak'
                                }"
                            >
                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                <span x-text="selectedItem?.status"></span>
                            </span>

                            <template x-if="selectedItem?.kadaluwarsa !== '-'">
                                <span
                                    class="inline-flex items-center gap-1 rounded-full border px-3 py-1 text-xs font-semibold"
                                    :class="{
                                        'border-emerald-300 bg-emerald-50 text-emerald-700': selectedItem?.kadaluwarsa === 'Aktif',
                                        'border-red-300 bg-red-50 text-red-700': selectedItem?.kadaluwarsa === 'Kadaluwarsa'
                                    }"
                                >
                                    <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                    <span x-text="selectedItem?.kadaluwarsa"></span>
                                </span>
                            </template>
                        </div>
                    </div>

                    {{-- Masa berlaku --}}
                    <template x-if="selectedItem?.kadaluwarsa === 'Aktif'">
                        <div class="flex items-center gap-3 rounded-xl border border-emerald-300 bg-emerald-50 px-4 py-3">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M8 7V3M16 7V3M4 11H20M6 5H18C19.1046 5 20 5.89543 20 7V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V7C4 5.89543 4.89543 5 6 5Z"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </div>

                            <div>
                                <p class="text-sm font-semibold text-emerald-700">
                                    Surat Masih Berlaku
                                </p>
                                <p class="text-xs text-emerald-600">
                                    Berlaku sampai:
                                    <span x-text="selectedItem?.tanggal_kadaluwarsa"></span>
                                </p>
                            </div>
                        </div>
                    </template>

                    <template x-if="selectedItem?.kadaluwarsa === 'Kadaluwarsa'">
                        <div class="flex items-center gap-3 rounded-xl border border-red-300 bg-red-50 px-4 py-3">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-100 text-red-600">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M12 9V13M12 17H12.01M10.29 3.86L1.82 18C1.43 18.67 1.91 19.5 2.68 19.5H21.32C22.09 19.5 22.57 18.67 22.18 18L13.71 3.86C13.32 3.2 10.68 3.2 10.29 3.86Z"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </div>

                            <div>
                                <p class="text-sm font-semibold text-red-700">
                                    Surat Kadaluwarsa
                                </p>
                                <p class="text-xs text-red-600">
                                    Berlaku sampai:
                                    <span x-text="selectedItem?.tanggal_kadaluwarsa"></span>
                                </p>
                            </div>
                        </div>
                    </template>
                </div>

                {{-- Informasi Mahasiswa --}}
                <div class="rounded-2xl bg-slate-50 p-4">
                    <h4 class="mb-4 flex items-center gap-2 font-semibold text-slate-700">
                        <svg class="h-4 w-4 text-slate-500" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M17 21V19C17 17.8954 16.1046 17 15 17H9C7.89543 17 7 17.8954 7 19V21M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                        Informasi Mahasiswa
                    </h4>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between gap-4">
                            <span class="text-slate-500">Nama</span>
                            <b class="text-right text-slate-700" x-text="selectedItem?.nama"></b>
                        </div>

                        <div class="flex justify-between gap-4">
                            <span class="text-slate-500">NIM</span>
                            <b class="text-right text-slate-700" x-text="selectedItem?.nim"></b>
                        </div>

                        <div class="flex justify-between gap-4">
                            <span class="text-slate-500">Program Studi</span>
                            <b class="text-right text-slate-700">Teknik Informatika</b>
                        </div>
                    </div>
                </div>

                {{-- Informasi Surat --}}
                <div class="rounded-2xl bg-slate-50 p-4">
                    <h4 class="mb-4 flex items-center gap-2 font-semibold text-slate-700">
                        <svg class="h-4 w-4 text-slate-500" viewBox="0 0 24 24" fill="none">
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
                        Informasi Surat
                    </h4>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between gap-4">
                            <span class="text-slate-500">Jenis Surat</span>
                            <b class="text-right text-slate-700" x-text="selectedItem?.jenis"></b>
                        </div>

                        <div class="flex justify-between gap-4">
                            <span class="text-slate-500">Keperluan</span>
                            <b class="max-w-sm text-right text-slate-700">
                                Pengajuan pinjaman KPR Bank Mandiri atas nama orang tua
                            </b>
                        </div>

                        <div class="flex justify-between gap-4">
                            <span class="text-slate-500">Tanggal Pengajuan</span>
                            <b class="text-right text-slate-700" x-text="selectedItem?.tanggal"></b>
                        </div>
                    </div>
                </div>

                {{-- Dokumen seharusnya --}}
                <div>
                    <h4 class="mb-3 flex items-center gap-2 text-sm font-semibold text-slate-700">
                        <svg class="h-4 w-4 text-slate-500" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M4 6H20M7 12H17M10 18H14"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                        Dokumen Pendukung yang Seharusnya Dilampirkan
                    </h4>

                    <div class="rounded-xl border border-amber-300 bg-amber-50 px-4 py-3 text-xs font-semibold">
                        <div class="space-y-2">
                            <p class="flex items-center gap-2 text-emerald-600">
                                <span class="flex h-4 w-4 items-center justify-center rounded-full bg-emerald-500 text-[10px] text-white">✓</span>
                                KTM (Kartu Tanda Mahasiswa)
                            </p>

                            <p class="flex items-center gap-2 text-emerald-600">
                                <span class="flex h-4 w-4 items-center justify-center rounded-full bg-emerald-500 text-[10px] text-white">✓</span>
                                KRS Semester Terbaru
                            </p>

                            <p class="flex items-center gap-2 text-amber-600">
                                <span class="flex h-4 w-4 items-center justify-center rounded-full bg-amber-400 text-[10px] text-white">!</span>
                                Bukti Pembayaran UKT
                            </p>
                        </div>
                    </div>
                </div>

                {{-- File Surat Pengajuan --}}
                <div>
                    <h4 class="mb-3 flex items-center gap-2 text-sm font-semibold text-slate-700">
                        <svg class="h-4 w-4 text-blue-500" viewBox="0 0 24 24" fill="none">
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
                        File Surat Pengajuan
                    </h4>

                    <div class="flex items-center justify-between rounded-xl border border-blue-200 bg-blue-50 px-4 py-3 text-sm">
                        <div class="flex min-w-0 items-center gap-3">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
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

                            <p class="truncate font-semibold text-slate-700">
                                Surat_Keterangan_Aktif_Anisa.pdf
                            </p>
                        </div>

                        <div class="ml-3 flex shrink-0 items-center gap-4 text-xs font-semibold">
                            <a href="#" class="text-blue-600 hover:text-blue-700">Lihat</a>
                            <a href="#" class="text-slate-500 hover:text-slate-700">Unduh</a>
                        </div>
                    </div>
                </div>

                {{-- Dokumen Dilampirkan --}}
                <div>
                    <h4 class="mb-3 flex items-center gap-2 text-sm font-semibold text-slate-700">
                        <svg class="h-4 w-4 text-slate-500" viewBox="0 0 24 24" fill="none">
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
                        Dokumen Pendukung yang Dilampirkan
                    </h4>

                    <div class="space-y-2">
                        <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm">
                            <div class="flex items-center gap-3">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-slate-500">
                                    📄
                                </div>
                                <p class="font-medium text-slate-700">KTM.pdf</p>
                            </div>

                            <a href="#" class="text-xs font-semibold text-blue-600 hover:text-blue-700">
                                Lihat
                            </a>
                        </div>

                        <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm">
                            <div class="flex items-center gap-3">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-slate-500">
                                    📄
                                </div>
                                <p class="font-medium text-slate-700">KRS_Semester_10.pdf</p>
                            </div>

                            <a href="#" class="text-xs font-semibold text-blue-600 hover:text-blue-700">
                                Lihat
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Catatan Admin TU --}}
                <div class="rounded-xl border border-blue-100 bg-blue-50 px-4 py-3">
                    <p class="mb-1 text-xs font-bold text-blue-600">
                        Catatan Admin TU
                    </p>
                    <p class="text-sm text-slate-600">
                        Dokumen lengkap.
                    </p>
                </div>

                {{-- Catatan Kaprodi --}}
                <div class="rounded-xl border border-purple-100 bg-purple-50 px-4 py-3">
                    <p class="mb-1 text-xs font-bold text-purple-600">
                        Catatan Kaprodi
                    </p>
                    <p class="text-sm text-slate-600">
                        Disetujui. Mahasiswa aktif semester 10.
                    </p>
                </div>

                {{-- Footer --}}
                <div class="border-t border-slate-100 pt-4">
                    <button
                        type="button"
                        @click="detailOpen = false"
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