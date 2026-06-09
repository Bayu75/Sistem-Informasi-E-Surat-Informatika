@extends('layouts.admin')

@section('title', 'Teruskan ke Kaprodi - Admin TU')
@section('page-title', 'Teruskan ke Kaprodi')

@php
    $activeMenu = 'teruskan';

    $items = [
        [
            'id' => 'S2',
            'nama' => 'Dewi Rahayu',
            'nim' => '2021002',
            'jenis' => 'Surat Pengantar PKL/Magang',
            'keperluan' => 'Magang di PT Teknologi Nusantara selama 3 bulan',
            'tanggal' => '18 Mei 2025',
            'status' => 'Diverifikasi Admin',
            'file_surat' => 'Surat_PKL_Dewi_Rahayu.pdf',
            'catatan_admin' => 'Dokumen lengkap, siap diteruskan ke Kaprodi.',
            'dokumen' => [
                'KTM.pdf',
                'Proposal_PKL.pdf',
                'Surat_Perusahaan.pdf',
            ],
            'syarat' => [
                ['nama' => 'KTM (Kartu Tanda Mahasiswa)', 'status' => 'lengkap'],
                ['nama' => 'Proposal PKL/Magang', 'status' => 'lengkap'],
                ['nama' => 'Surat Penerimaan dari Perusahaan/Instansi', 'status' => 'kurang'],
            ],
        ],
        [
            'id' => 'S3',
            'nama' => 'Maya Sari',
            'nim' => '2021045',
            'jenis' => 'Surat Cuti Kuliah',
            'keperluan' => 'Pengajuan cuti kuliah karena keperluan keluarga',
            'tanggal' => '19 Mei 2025',
            'status' => 'Diverifikasi Admin',
            'file_surat' => 'Surat_Cuti_Maya_Sari.pdf',
            'catatan_admin' => 'Dokumen telah diverifikasi dan dapat diteruskan.',
            'dokumen' => [
                'KTM.pdf',
                'Surat_Permohonan_Cuti.pdf',
                'Bukti_Pendukung.pdf',
            ],
            'syarat' => [
                ['nama' => 'KTM (Kartu Tanda Mahasiswa)', 'status' => 'lengkap'],
                ['nama' => 'Surat Permohonan Cuti', 'status' => 'lengkap'],
                ['nama' => 'Bukti Pendukung', 'status' => 'kurang'],
            ],
        ],
    ];
@endphp

@section('content')
<div
    x-data="{
        detailOpen: false,
        selectedItem: null,
        search: '',

        items: @js($items),

        get filteredItems() {
            const keyword = this.search.toLowerCase();

            return this.items.filter((item) => {
                return item.nama.toLowerCase().includes(keyword)
                    || item.nim.toLowerCase().includes(keyword)
                    || item.jenis.toLowerCase().includes(keyword)
                    || item.id.toLowerCase().includes(keyword);
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
    {{-- Alert --}}
    <section class="mb-5 rounded-2xl border border-blue-300 bg-blue-50 px-5 py-4">
        <div class="flex items-start gap-3">
            <div class="mt-0.5 flex h-7 w-7 items-center justify-center text-blue-600">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M22 2L11 13"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                    <path
                        d="M22 2L15 22L11 13L2 9L22 2Z"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </div>

            <div>
                <h3 class="font-semibold text-blue-700">
                    2 pengajuan siap diteruskan
                </h3>
                <p class="text-sm text-blue-600">
                    Pengajuan yang telah diverifikasi dapat diteruskan ke Kaprodi untuk persetujuan.
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
                x-model="search"
                placeholder="Cari pengajuan terverifikasi..."
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
                    <template x-for="item in filteredItems" :key="item.id">
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
                                <span class="inline-flex items-center gap-1 rounded-full border border-blue-300 bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
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
                            Tidak ada pengajuan terverifikasi yang sesuai dengan pencarian.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    {{-- Modal Detail Teruskan --}}
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

                    <span class="inline-flex items-center gap-1 rounded-full border border-blue-300 bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
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

                {{-- Catatan Admin --}}
                <div class="rounded-xl border border-blue-100 bg-blue-50 px-4 py-3">
                    <p class="mb-1 text-xs font-bold text-blue-600">
                        Catatan Admin TU
                    </p>

                    <p class="text-sm text-slate-600" x-text="selectedItem?.catatan_admin"></p>
                </div>

                {{-- Footer --}}
                <div class="grid gap-3 border-t border-slate-100 pt-4 sm:grid-cols-[1fr_1fr]">
                    <button
                        type="button"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                    >
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M5 12H19M19 12L13 6M19 12L13 18"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                        Teruskan ke Kaprodi
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
</div>
@endsection