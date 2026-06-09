@extends('layouts.admin')

@section('title', 'Pengajuan Masuk - Admin TU')
@section('page-title', 'Pengajuan Masuk')

@php
    $activeMenu = 'pengajuan-masuk';

    $pengajuan = [
        [
            'id' => 'S7',
            'nama' => 'Ahmad Rizal',
            'nim' => '2022010',
            'jenis' => 'Surat Dispensasi',
            'tanggal' => '22 Mei 2025',
            'status' => 'Menunggu Verifikasi',
            'waktu' => 'minggu_ini',
            'urutan' => 9,
        ],
        [
            'id' => 'S1',
            'nama' => 'Budi Santoso',
            'nim' => '2021001',
            'jenis' => 'Surat Keterangan Aktif Kuliah',
            'tanggal' => '20 Mei 2025',
            'status' => 'Menunggu Verifikasi',
            'waktu' => 'minggu_ini',
            'urutan' => 8,
        ],
        [
            'id' => 'S3',
            'nama' => 'Maya Sari',
            'nim' => '2021045',
            'jenis' => 'Surat Cuti Kuliah',
            'tanggal' => '19 Mei 2025',
            'status' => 'Diverifikasi Admin',
            'waktu' => 'minggu_ini',
            'urutan' => 7,
        ],
        [
            'id' => 'S2',
            'nama' => 'Dewi Rahayu',
            'nim' => '2021002',
            'jenis' => 'Surat Pengantar PKL/Magang',
            'tanggal' => '18 Mei 2025',
            'status' => 'Diverifikasi Admin',
            'waktu' => 'minggu_ini',
            'urutan' => 6,
        ],
        [
            'id' => 'S8',
            'nama' => 'Rizky Pratama',
            'nim' => '2020015',
            'jenis' => 'Surat Permohonan Beasiswa',
            'tanggal' => '15 Mei 2025',
            'status' => 'Diteruskan ke Kaprodi',
            'waktu' => 'bulan_ini',
            'urutan' => 5,
        ],
        [
            'id' => 'S1B',
            'nama' => 'Budi Santoso',
            'nim' => '2021001',
            'jenis' => 'Surat Dispensasi',
            'tanggal' => '10 Mei 2025',
            'status' => 'Ditolak',
            'waktu' => 'bulan_ini',
            'urutan' => 4,
        ],
        [
            'id' => 'S4',
            'nama' => 'Anisa Putri',
            'nim' => '2020020',
            'jenis' => 'Surat Keterangan Aktif Kuliah',
            'tanggal' => '10 Mei 2025',
            'status' => 'Disetujui',
            'waktu' => 'bulan_ini',
            'urutan' => 3,
        ],
        [
            'id' => 'S5',
            'nama' => 'Fauzan Malik',
            'nim' => '2021030',
            'jenis' => 'Surat Rekomendasi',
            'tanggal' => '8 Mei 2025',
            'status' => 'Ditolak',
            'waktu' => 'bulan_ini',
            'urutan' => 2,
        ],
        [
            'id' => 'S6',
            'nama' => 'Sari Wulandari',
            'nim' => '2019005',
            'jenis' => 'Surat Keterangan Lulus',
            'tanggal' => '25 Apr 2025',
            'status' => 'Disetujui',
            'waktu' => 'bulan_ini',
            'urutan' => 1,
        ],
    ];
@endphp

@section('content')
<div
    x-data="{
        detailOpen: false,
        rejectOpen: false,

        search: '',
        jenis: '',
        status: '',
        waktu: '',
        sort: 'terbaru',

        selectedItem: null,

        items: @js($pengajuan),

        get filteredItems() {
            let result = this.items.filter((item) => {
                const keyword = this.search.toLowerCase();

                const matchSearch =
                    item.nama.toLowerCase().includes(keyword) ||
                    item.nim.toLowerCase().includes(keyword) ||
                    item.id.toLowerCase().includes(keyword);

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
        },

        openReject() {
            this.detailOpen = false;
            this.rejectOpen = true;
        }
    }"
>
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
                    placeholder="Cari nama mahasiswa atau NIM..."
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
                <option value="Surat Cuti Kuliah">Surat Cuti Kuliah</option>
                <option value="Surat Pengantar PKL/Magang">Surat Pengantar PKL/Magang</option>
                <option value="Surat Permohonan Beasiswa">Surat Permohonan Beasiswa</option>
                <option value="Surat Rekomendasi">Surat Rekomendasi</option>
                <option value="Surat Keterangan Lulus">Surat Keterangan Lulus</option>
            </select>

            {{-- Status --}}
            <select
                x-model="status"
                class="h-11 rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
            >
                <option value="">Semua Status</option>
                <option value="Menunggu Verifikasi">Menunggu Verifikasi</option>
                <option value="Diverifikasi Admin">Diverifikasi Admin</option>
                <option value="Diteruskan ke Kaprodi">Diteruskan ke Kaprodi</option>
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
            <p class="text-xs text-slate-500">
                Menampilkan
                <b x-text="filteredItems.length"></b>
                dari
                <b x-text="items.length"></b>
                pengajuan
            </p>
        </div>
    </section>

    {{-- Table --}}
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
                                    <span
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 text-xs font-bold text-blue-600"
                                        x-text="item.nama.charAt(0)"
                                    ></span>

                                    <span x-text="item.nama"></span>
                                </div>
                            </td>

                            <td class="px-5 py-4" x-text="item.nim"></td>

                            <td class="px-5 py-4" x-text="item.jenis"></td>

                            <td class="px-5 py-4" x-text="item.tanggal"></td>

                            <td class="px-5 py-4">
                                <span
                                    class="inline-flex items-center gap-1 rounded-full border px-3 py-1 text-xs font-semibold"
                                    :class="{
                                        'border-amber-300 bg-amber-50 text-amber-700': item.status === 'Menunggu Verifikasi',
                                        'border-blue-300 bg-blue-50 text-blue-700': item.status === 'Diverifikasi Admin',
                                        'border-purple-300 bg-purple-50 text-purple-700': item.status === 'Diteruskan ke Kaprodi',
                                        'border-emerald-300 bg-emerald-50 text-emerald-700': item.status === 'Disetujui',
                                        'border-red-300 bg-red-50 text-red-700': item.status === 'Ditolak'
                                    }"
                                >
                                    <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                    <span x-text="item.status"></span>
                                </span>
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
                        <td colspan="6" class="px-5 py-10 text-center text-sm text-slate-400">
                            Tidak ada data pengajuan yang sesuai dengan filter.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    {{-- Modal Detail Pengajuan --}}
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
            {{-- Header --}}
            <div class="flex items-start justify-between border-b border-slate-100 px-5 py-4">
                <div>
                    <h3 class="text-xl font-semibold text-slate-800">
                        Detail Pengajuan Surat
                    </h3>
                    <p class="mt-0.5 text-sm text-slate-400">
                        ID:
                        <span x-text="selectedItem?.id"></span>
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

            {{-- Body --}}
            <div class="space-y-4 p-5" x-show="selectedItem">
                {{-- Status --}}
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <span class="text-sm font-medium text-slate-500">
                        Status saat ini:
                    </span>

                    <span
                        class="inline-flex items-center gap-1 rounded-full border px-3 py-1 text-xs font-semibold"
                        :class="{
                            'border-amber-300 bg-amber-50 text-amber-700': selectedItem?.status === 'Menunggu Verifikasi',
                            'border-blue-300 bg-blue-50 text-blue-700': selectedItem?.status === 'Diverifikasi Admin',
                            'border-purple-300 bg-purple-50 text-purple-700': selectedItem?.status === 'Diteruskan ke Kaprodi',
                            'border-emerald-300 bg-emerald-50 text-emerald-700': selectedItem?.status === 'Disetujui',
                            'border-red-300 bg-red-50 text-red-700': selectedItem?.status === 'Ditolak'
                        }"
                    >
                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                        <span x-text="selectedItem?.status"></span>
                    </span>
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
                                <template x-if="selectedItem?.id === 'S7'">
                                    <span>Mengikuti lomba programming tingkat nasional di Jakarta</span>
                                </template>

                                <template x-if="selectedItem?.id === 'S1'">
                                    <span>Pengajuan beasiswa dari Yayasan Pendidikan Nusantara</span>
                                </template>

                                <template x-if="selectedItem?.id !== 'S7' && selectedItem?.id !== 'S1'">
                                    <span>Keperluan administrasi akademik mahasiswa</span>
                                </template>
                            </b>
                        </div>

                        <div class="flex justify-between gap-4">
                            <span class="text-slate-500">Tanggal Pengajuan</span>
                            <b class="text-right text-slate-700" x-text="selectedItem?.tanggal"></b>
                        </div>
                    </div>
                </div>

                {{-- Dokumen Seharusnya --}}
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
                            <template x-if="selectedItem?.id === 'S7'">
                                <div class="space-y-2">
                                    <p class="flex items-center gap-2 text-emerald-600">
                                        <span class="flex h-4 w-4 items-center justify-center rounded-full bg-emerald-500 text-[10px] text-white">✓</span>
                                        KTM (Kartu Tanda Mahasiswa)
                                    </p>
                                    <p class="flex items-center gap-2 text-emerald-600">
                                        <span class="flex h-4 w-4 items-center justify-center rounded-full bg-emerald-500 text-[10px] text-white">✓</span>
                                        Undangan/Surat Resmi Kegiatan
                                    </p>
                                    <p class="flex items-center gap-2 text-amber-600">
                                        <span class="flex h-4 w-4 items-center justify-center rounded-full bg-amber-400 text-[10px] text-white">!</span>
                                        Jadwal Kegiatan
                                    </p>
                                </div>
                            </template>

                            <template x-if="selectedItem?.id !== 'S7'">
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
                            </template>
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
                            <div class="flex min-w-0 items-center gap-3">
                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-500">
                                    📄
                                </div>
                                <p class="truncate font-medium text-slate-700">KTM.pdf</p>
                            </div>

                            <a href="#" class="ml-3 shrink-0 text-xs font-semibold text-blue-600 hover:text-blue-700">
                                Lihat
                            </a>
                        </div>

                        <template x-if="selectedItem?.id === 'S7'">
                            <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm">
                                <div class="flex min-w-0 items-center gap-3">
                                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-500">
                                        📄
                                    </div>
                                    <p class="truncate font-medium text-slate-700">Undangan_Lomba.pdf</p>
                                </div>

                                <a href="#" class="ml-3 shrink-0 text-xs font-semibold text-blue-600 hover:text-blue-700">
                                    Lihat
                                </a>
                            </div>
                        </template>

                        <template x-if="selectedItem?.id !== 'S7'">
                            <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm">
                                <div class="flex min-w-0 items-center gap-3">
                                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-500">
                                        📄
                                    </div>
                                    <p class="truncate font-medium text-slate-700">KRS_Semester_8.pdf</p>
                                </div>

                                <a href="#" class="ml-3 shrink-0 text-xs font-semibold text-blue-600 hover:text-blue-700">
                                    Lihat
                                </a>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- Footer Button --}}
                <div class="grid gap-3 border-t border-slate-100 pt-4 sm:grid-cols-3">
                    <button
                        type="button"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-emerald-700"
                    >
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M20 6L9 17L4 12"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                        Verifikasi
                    </button>

                    <button
                        type="button"
                        @click="openReject()"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-600 transition hover:bg-red-100"
                    >
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M18 6L6 18M6 6L18 18"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                        Tolak
                    </button>

                    <button
                        type="button"
                        @click="detailOpen = false"
                        class="rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                    >
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection