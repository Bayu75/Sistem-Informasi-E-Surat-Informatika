@extends('layouts.admin')

@section('title', 'Verifikasi Pengajuan - Admin TU')
@section('page-title', 'Verifikasi Pengajuan')

@php
    $activeMenu = 'verifikasi';

    $items = [
        [
            'id' => 'S1',
            'nama' => 'Budi Santoso',
            'nim' => '2021001',
            'jenis' => 'Surat Keterangan Aktif Kuliah',
            'keperluan' => 'Pengajuan beasiswa dari Yayasan Pendidikan Nusantara',
            'tanggal' => '20 Mei 2025',
            'status' => 'Menunggu Verifikasi',
            'file_surat' => 'Surat_Permohonan_Beasiswa_Budi.pdf',
            'dokumen' => ['KTM.pdf', 'KRS_Semester_8.pdf'],
            'syarat' => [
                ['nama' => 'KTM (Kartu Tanda Mahasiswa)', 'status' => 'lengkap'],
                ['nama' => 'KRS Semester Terbaru', 'status' => 'lengkap'],
                ['nama' => 'Bukti Pembayaran UKT', 'status' => 'kurang'],
            ],
        ],
        [
            'id' => 'S7',
            'nama' => 'Ahmad Rizal',
            'nim' => '2022010',
            'jenis' => 'Surat Dispensasi',
            'keperluan' => 'Mengikuti lomba programming tingkat nasional di Jakarta',
            'tanggal' => '22 Mei 2025',
            'status' => 'Menunggu Verifikasi',
            'file_surat' => 'Surat_Dispensasi_Ahmad_Rizal.pdf',
            'dokumen' => ['KTM.pdf', 'Undangan_Lomba.pdf'],
            'syarat' => [
                ['nama' => 'KTM (Kartu Tanda Mahasiswa)', 'status' => 'lengkap'],
                ['nama' => 'Undangan/Surat Resmi Kegiatan', 'status' => 'lengkap'],
                ['nama' => 'Jadwal Kegiatan', 'status' => 'kurang'],
            ],
        ],
    ];
@endphp

@section('content')
<div
    x-data="{
        detailOpen: false,
        rejectOpen: false,
        selectedItem: null,

        items: @js($items),

        openDetail(item) {
            this.selectedItem = item;
            this.detailOpen = true;
        },

        closeDetail() {
            this.detailOpen = false;
            this.selectedItem = null;
        },

        openReject() {
            this.detailOpen = false;
            this.rejectOpen = true;
        },

        closeReject() {
            this.rejectOpen = false;
        }
    }"
>
    {{-- Alert --}}
    <section class="mb-5 rounded-2xl border border-amber-300 bg-amber-50 px-5 py-4">
        <div class="flex items-start gap-3">
            <div class="mt-0.5 flex h-6 w-6 items-center justify-center rounded-full border border-amber-500 text-sm font-bold text-amber-600">
                !
            </div>

            <div>
                <h3 class="font-semibold text-amber-700">
                    2 pengajuan menunggu verifikasi
                </h3>
                <p class="text-sm text-amber-600">
                    Periksa kelengkapan dokumen. Anda dapat memverifikasi atau menolak pengajuan.
                </p>
            </div>
        </div>
    </section>

    {{-- Search --}}
    <div class="mb-5">
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
                placeholder="Cari pengajuan..."
                class="h-11 w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-11 pr-4 text-sm text-slate-700 placeholder:text-slate-400 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
            >
        </div>
    </div>

    {{-- Table --}}
    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
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

                <tbody class="divide-y divide-slate-100">
                    <template x-for="item in items" :key="item.id">
                        <tr class="transition hover:bg-slate-50/60">
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
                                <span class="inline-flex items-center gap-1 rounded-full border border-amber-300 bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
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
                </tbody>
            </table>
        </div>
    </section>

    {{-- Modal Detail Verifikasi --}}
    <div
        x-show="detailOpen"
        x-transition.opacity
        class="fixed inset-0 z-[60] flex items-center justify-center bg-slate-900/50 px-4 py-6"
        style="display: none;"
    >
        <div
            @click.outside="closeDetail()"
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
                    @click="closeDetail()"
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

                    <span class="inline-flex items-center gap-1 rounded-full border border-amber-300 bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
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
                            <b class="max-w-sm text-right text-slate-700" x-text="selectedItem?.keperluan"></b>
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
                            <template x-for="syarat in selectedItem?.syarat" :key="syarat.nama">
                                <p
                                    class="flex items-center gap-2"
                                    :class="{
                                        'text-emerald-600': syarat.status === 'lengkap',
                                        'text-amber-600': syarat.status === 'kurang'
                                    }"
                                >
                                    <span
                                        class="flex h-4 w-4 items-center justify-center rounded-full text-[10px] text-white"
                                        :class="{
                                            'bg-emerald-500': syarat.status === 'lengkap',
                                            'bg-amber-400': syarat.status === 'kurang'
                                        }"
                                        x-text="syarat.status === 'lengkap' ? '✓' : '!'"
                                    ></span>
                                    <span x-text="syarat.nama"></span>
                                </p>
                            </template>
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

                            <p class="truncate font-semibold text-slate-700" x-text="selectedItem?.file_surat"></p>
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
                        <template x-for="dokumen in selectedItem?.dokumen" :key="dokumen">
                            <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm">
                                <div class="flex min-w-0 items-center gap-3">
                                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-500">
                                        📄
                                    </div>

                                    <p class="truncate font-medium text-slate-700" x-text="dokumen"></p>
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
                        @click="closeDetail()"
                        class="rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                    >
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tolak --}}
    <div
        x-show="rejectOpen"
        x-transition.opacity
        class="fixed inset-0 z-[70] flex items-center justify-center bg-slate-900/50 px-4 py-6"
        style="display: none;"
    >
        <div
            @click.outside="closeReject()"
            class="w-full max-w-lg rounded-2xl bg-white p-6 shadow-2xl"
        >
            <div class="mb-5 flex items-center justify-between">
                <h3 class="text-xl font-semibold text-slate-800">
                    Tolak Pengajuan
                </h3>

                <button
                    type="button"
                    @click="closeReject()"
                    class="text-2xl leading-none text-slate-400 hover:text-slate-600"
                >
                    &times;
                </button>
            </div>

            <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm">
                <p class="mb-3 font-semibold text-red-600">
                    Pengajuan yang akan ditolak:
                </p>

                <div class="space-y-2">
                    <div class="flex justify-between gap-4">
                        <span class="text-slate-500">Mahasiswa</span>
                        <b class="text-right text-slate-700" x-text="selectedItem?.nama"></b>
                    </div>

                    <div class="flex justify-between gap-4">
                        <span class="text-slate-500">NIM</span>
                        <b class="text-right text-slate-700" x-text="selectedItem?.nim"></b>
                    </div>

                    <div class="flex justify-between gap-4">
                        <span class="text-slate-500">Jenis Surat</span>
                        <b class="text-right text-slate-700" x-text="selectedItem?.jenis"></b>
                    </div>
                </div>
            </div>

            <label class="mb-2 block text-sm font-semibold text-slate-700">
                Alasan Penolakan <span class="text-red-500">*</span>
            </label>

            <textarea
                rows="5"
                maxlength="500"
                placeholder="Jelaskan alasan penolakan secara jelas dan rinci..."
                class="w-full rounded-xl border border-red-200 p-4 text-sm outline-none transition focus:border-red-400 focus:ring-4 focus:ring-red-100"
            ></textarea>

            <p class="mt-2 text-xs text-slate-400">0/500 karakter</p>

            <div class="mt-5 rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-700">
                Tindakan ini tidak dapat dibatalkan. Mahasiswa akan mendapatkan notifikasi penolakan beserta alasannya.
            </div>

            <div class="mt-5 grid gap-3 sm:grid-cols-2">
                <button
                    type="button"
                    @click="closeReject()"
                    class="rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                >
                    Batal
                </button>

                <button
                    type="button"
                    class="rounded-xl bg-red-400 px-4 py-3 text-sm font-semibold text-white transition hover:bg-red-500"
                >
                    Konfirmasi Tolak
                </button>
            </div>
        </div>
    </div>
</div>
@endsection