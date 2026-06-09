@extends('layouts.admin')

@section('title', 'Pengumuman - Admin TU')
@section('page-title', 'Pengumuman')

@php
    $activeMenu = 'pengumuman';

    $announcements = [
        [
            'id' => 'P1',
            'status' => 'Aktif',
            'kategori' => 'Akademik',
            'title' => 'Jadwal Ujian Akhir Semester (UAS) Genap 2024/2025',
            'desc' => 'UAS semester genap akan dilaksanakan pada tanggal 9-20 Juni 2025. Mahasiswa wajib hadir tepat waktu.',
            'content' => 'Diberitahukan kepada seluruh mahasiswa bahwa pelaksanaan Ujian Akhir Semester (UAS) Genap Tahun Akademik 2024/2025 akan dilaksanakan pada tanggal 9 sampai 20 Juni 2025. Mahasiswa wajib memperhatikan jadwal ujian, membawa kartu ujian, dan hadir tepat waktu sesuai ketentuan akademik.',
            'date' => '20 Mei 2025',
            'author' => 'Siti Rahma, S.Kom',
            'file' => 'Jadwal_UAS_Genap_2025.pdf',
            'size' => '342 KB',
        ],
        [
            'id' => 'P2',
            'status' => 'Aktif',
            'kategori' => 'Beasiswa',
            'title' => 'Pendaftaran Beasiswa Bidikmisi Tahap 2 Tahun 2025',
            'desc' => 'Pendaftaran beasiswa Bidikmisi tahap 2 dibuka mulai 1 Juni 2025. Segera lengkapi berkas persyaratan.',
            'content' => 'Pendaftaran Beasiswa Bidikmisi Tahap 2 Tahun 2025 telah dibuka untuk mahasiswa yang memenuhi kriteria. Mahasiswa diminta untuk melengkapi berkas persyaratan dan mengunggah dokumen pendukung sesuai jadwal yang telah ditentukan.',
            'date' => '15 Mei 2025',
            'author' => 'Siti Rahma, S.Kom',
            'file' => 'Pengumuman_Beasiswa_Bidikmisi_2025.pdf',
            'size' => '215 KB',
        ],
        [
            'id' => 'P3',
            'status' => 'Aktif',
            'kategori' => 'Akademik',
            'title' => 'Pengumuman Wisuda Periode Agustus 2025',
            'desc' => 'Wisuda periode Agustus 2025 akan dilaksanakan pada 23 Agustus 2025. Pendaftaran dibuka mulai 1 Juli 2025.',
            'content' => 'Diberitahukan kepada mahasiswa tingkat akhir bahwa pelaksanaan wisuda periode Agustus 2025 akan diselenggarakan pada tanggal 23 Agustus 2025. Pendaftaran wisuda dibuka mulai 1 Juli 2025 melalui bagian akademik.',
            'date' => '10 Mei 2025',
            'author' => 'Siti Rahma, S.Kom',
            'file' => 'Pengumuman_Wisuda_Agustus_2025.pdf',
            'size' => '298 KB',
        ],
        [
            'id' => 'P4',
            'status' => 'Aktif',
            'kategori' => 'Akademik',
            'title' => 'Pengisian KRS Online Semester Ganjil 2025/2026',
            'desc' => 'Pengisian KRS semester ganjil 2025/2026 dimulai 15 Juni 2025. Konsultasikan dengan dosen wali terlebih dahulu.',
            'content' => 'Pengisian Kartu Rencana Studi (KRS) Online untuk Semester Ganjil Tahun Akademik 2025/2026 akan dibuka mulai tanggal 15 Juni 2025. Mahasiswa wajib melakukan konsultasi dengan dosen wali sebelum melakukan pengisian KRS.',
            'date' => '5 Mei 2025',
            'author' => 'Siti Rahma, S.Kom',
            'file' => 'Panduan_Pengisian_KRS_Ganjil_2025.pdf',
            'size' => '187 KB',
        ],
        [
            'id' => 'P5',
            'status' => 'Nonaktif',
            'kategori' => 'Kemahasiswaan',
            'title' => 'Informasi Pelaksanaan PKL dan Magang Semester Genap',
            'desc' => 'PKL dan magang semester genap dapat dilaksanakan mulai 1 Juli 2025. Segera ajukan surat pengantar.',
            'content' => 'Mahasiswa yang akan melaksanakan PKL atau magang pada Semester Genap dapat mulai mengajukan surat pengantar melalui sistem SIERA. Pelaksanaan PKL dan magang dapat dimulai pada tanggal 1 Juli 2025 sesuai ketentuan program studi.',
            'date' => '28 April 2025',
            'author' => 'Siti Rahma, S.Kom',
            'file' => 'Informasi_PKL_Magang_Semester_Genap.pdf',
            'size' => '256 KB',
        ],
    ];
@endphp

@section('content')
<div
    x-data="{
        modalOpen: false,
        detailOpen: false,
        selectedAnnouncement: null,

        announcements: @js($announcements),

        openDetail(item) {
            this.selectedAnnouncement = item;
            this.detailOpen = true;
        },

        closeDetail() {
            this.detailOpen = false;
            this.selectedAnnouncement = null;
        }
    }"
>
    {{-- Header Action --}}
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <p class="text-sm text-slate-600">
            <span class="font-semibold">{{ count($announcements) }}</span>
            total pengumuman
        </p>

        <button
            type="button"
            @click="modalOpen = true"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
        >
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                <path
                    d="M12 5V19M5 12H19"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
            Tambah Pengumuman
        </button>
    </div>

    {{-- List Pengumuman --}}
    <section class="space-y-4">
        <template x-for="item in announcements" :key="item.id">
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div class="min-w-0 flex-1">
                        <div class="mb-3 flex flex-wrap gap-2">
                            <span
                                class="inline-flex items-center gap-1 rounded-full border px-3 py-1 text-xs font-semibold"
                                :class="{
                                    'border-emerald-300 bg-emerald-50 text-emerald-700': item.status === 'Aktif',
                                    'border-slate-300 bg-slate-100 text-slate-600': item.status === 'Nonaktif'
                                }"
                            >
                                <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                <span x-text="item.status"></span>
                            </span>

                            <span
                                class="rounded-full px-3 py-1 text-xs font-semibold"
                                :class="{
                                    'bg-blue-100 text-blue-600': item.kategori === 'Akademik',
                                    'bg-indigo-100 text-indigo-600': item.kategori === 'Beasiswa',
                                    'bg-purple-100 text-purple-600': item.kategori === 'Kemahasiswaan'
                                }"
                                x-text="item.kategori"
                            ></span>
                        </div>

                        <h3 class="font-semibold text-slate-800" x-text="item.title"></h3>

                        <p class="mt-1 text-sm text-slate-500" x-text="item.desc"></p>

                        <p class="mt-3 flex items-center gap-1 text-sm text-slate-400">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M8 7V3M16 7V3M4 11H20M6 5H18C19.1046 5 20 5.89543 20 7V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V7C4 5.89543 4.89543 5 6 5Z"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>

                            <span x-text="item.date"></span>
                            <span>·</span>
                            <span x-text="item.author"></span>
                        </p>

                        {{-- Dokumen Resmi --}}
                        <div class="mt-4 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
                            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                <div class="flex min-w-0 items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-red-50 text-xs font-bold text-red-500">
                                        PDF
                                    </div>

                                    <div class="min-w-0">
                                        <p class="truncate text-sm font-semibold text-slate-700" x-text="item.file"></p>
                                        <p class="text-xs text-slate-400" x-text="item.size"></p>
                                    </div>
                                </div>

                                <div class="flex shrink-0 items-center gap-4 text-xs font-semibold">
                                    <a href="#" class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-700">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M2 12C2 12 5.5 5 12 5C18.5 5 22 12 22 12C22 12 18.5 19 12 19C5.5 19 2 12 2 12Z"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />
                                        </svg>
                                        Lihat
                                    </a>

                                    <a href="#" class="inline-flex items-center gap-1 text-slate-500 hover:text-slate-700">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M12 3V15M12 15L7 10M12 15L17 10M5 21H19"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />
                                        </svg>
                                        Unduh
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex shrink-0 items-center gap-3">
                        {{-- Detail --}}
                        <button
                            type="button"
                            @click="openDetail(item)"
                            class="inline-flex items-center gap-1 text-sm font-semibold text-blue-600 transition hover:text-blue-700 cursor-pointer"
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

                        {{-- Hapus --}}
                        <button
                            type="button"
                            class="text-red-400 transition hover:text-red-600 cursor-pointer"
                        >
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M3 6H21M8 6V4H16V6M6 6L7 20H17L18 6M10 10V16M14 10V16"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </article>
        </template>
    </section>

    {{-- Modal Detail Pengumuman --}}
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
                        Detail Pengumuman Resmi
                    </h3>
                    <p class="mt-0.5 text-sm text-slate-400">
                        ID:
                        <span x-text="selectedAnnouncement?.id"></span>
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
            <div class="space-y-5 p-5" x-show="selectedAnnouncement">
                <div class="flex flex-wrap items-center gap-2">
                    <span
                        class="inline-flex items-center gap-1 rounded-full border px-3 py-1 text-xs font-semibold"
                        :class="{
                            'border-emerald-300 bg-emerald-50 text-emerald-700': selectedAnnouncement?.status === 'Aktif',
                            'border-slate-300 bg-slate-100 text-slate-600': selectedAnnouncement?.status === 'Nonaktif'
                        }"
                    >
                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                        <span x-text="selectedAnnouncement?.status"></span>
                    </span>

                    <span
                        class="rounded-full px-3 py-1 text-xs font-semibold"
                        :class="{
                            'bg-blue-100 text-blue-600': selectedAnnouncement?.kategori === 'Akademik',
                            'bg-indigo-100 text-indigo-600': selectedAnnouncement?.kategori === 'Beasiswa',
                            'bg-purple-100 text-purple-600': selectedAnnouncement?.kategori === 'Kemahasiswaan'
                        }"
                        x-text="selectedAnnouncement?.kategori"
                    ></span>
                </div>

                {{-- Informasi Pengumuman --}}
                <div class="rounded-2xl bg-slate-50 p-4">
                    <h4 class="mb-4 flex items-center gap-2 font-semibold text-slate-700">
                        <svg class="h-4 w-4 text-slate-500" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M4 5H20V19H4V5ZM8 9H16M8 13H14"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                        Informasi Pengumuman
                    </h4>

                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="mb-1 text-slate-500">Judul</p>
                            <p class="font-semibold text-slate-800" x-text="selectedAnnouncement?.title"></p>
                        </div>

                        <div>
                            <p class="mb-1 text-slate-500">Ringkasan</p>
                            <p class="text-slate-700" x-text="selectedAnnouncement?.desc"></p>
                        </div>

                        <div class="grid gap-3 sm:grid-cols-2">
                            <div>
                                <p class="mb-1 text-slate-500">Tanggal Pengumuman</p>
                                <p class="font-semibold text-slate-700" x-text="selectedAnnouncement?.date"></p>
                            </div>

                            <div>
                                <p class="mb-1 text-slate-500">Dibuat oleh</p>
                                <p class="font-semibold text-slate-700" x-text="selectedAnnouncement?.author"></p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Isi Pengumuman --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-4">
                    <h4 class="mb-3 font-semibold text-slate-700">
                        Isi Pengumuman
                    </h4>

                    <p class="text-sm leading-6 text-slate-600" x-text="selectedAnnouncement?.content"></p>
                </div>

                {{-- Dokumen Resmi --}}
                <div>
                    <h4 class="mb-3 flex items-center gap-2 text-sm font-semibold text-slate-700">
                        <svg class="h-4 w-4 text-red-500" viewBox="0 0 24 24" fill="none">
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
                        Dokumen Resmi
                    </h4>

                    <div class="flex items-center justify-between rounded-xl border border-red-100 bg-red-50 px-4 py-3 text-sm">
                        <div class="flex min-w-0 items-center gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-white text-xs font-bold text-red-500">
                                PDF
                            </div>

                            <div class="min-w-0">
                                <p class="truncate font-semibold text-slate-700" x-text="selectedAnnouncement?.file"></p>
                                <p class="text-xs text-slate-400" x-text="selectedAnnouncement?.size"></p>
                            </div>
                        </div>

                        <div class="ml-3 flex shrink-0 items-center gap-4 text-xs font-semibold">
                            <a href="#" class="text-blue-600 hover:text-blue-700">Lihat</a>
                            <a href="#" class="text-slate-500 hover:text-slate-700">Unduh</a>
                        </div>
                    </div>
                </div>

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

    {{-- Modal Tambah Pengumuman --}}
    <div
        x-show="modalOpen"
        x-transition.opacity
        class="fixed inset-0 z-[60] flex items-center justify-center bg-slate-900/50 px-4 py-6"
        style="display: none;"
    >
        <div
            @click.outside="modalOpen = false"
            class="max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-2xl bg-white shadow-2xl"
        >
            <div class="flex items-start justify-between border-b border-slate-100 p-5">
                <div>
                    <h3 class="text-xl font-semibold text-slate-800">
                        Tambah Pengumuman Resmi
                    </h3>
                    <p class="text-sm text-slate-400">
                        Isi semua informasi pengumuman dengan lengkap
                    </p>
                </div>

                <button
                    type="button"
                    @click="modalOpen = false"
                    class="text-2xl text-slate-400 hover:text-slate-600"
                >
                    &times;
                </button>
            </div>

            <form class="space-y-4 p-5">
                <div>
                    <label class="mb-2 block text-sm font-semibold">
                        Judul Pengumuman <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        placeholder="Masukkan judul pengumuman..."
                        class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    >
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-semibold">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            placeholder="Contoh: Akademik"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                        >
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold">
                            Tanggal Pengumuman <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="date"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                        >
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold">
                        Ringkasan <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        rows="3"
                        placeholder="Ringkasan singkat pengumuman..."
                        class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    ></textarea>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold">
                        Isi Pengumuman <span class="text-slate-400">(Opsional)</span>
                    </label>
                    <textarea
                        rows="5"
                        placeholder="Isi lengkap pengumuman..."
                        class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    ></textarea>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold">
                        Upload Surat Resmi <span class="text-red-500">*</span>
                        <span class="text-slate-400">(Format file: PDF)</span>
                    </label>

                    <label class="flex min-h-32 cursor-pointer flex-col items-center justify-center rounded-xl border border-dashed border-slate-300 bg-slate-50 text-center transition hover:border-blue-300 hover:bg-blue-50/40">
                        <span class="mb-2 flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-500">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M12 5V15M12 5L8 9M12 5L16 9M5 19H19"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </span>

                        <span class="text-sm font-semibold text-slate-600">
                            Klik untuk upload surat resmi
                        </span>
                        <span class="text-xs text-slate-400">
                            Format file: PDF — maks. 10 MB
                        </span>

                        <input type="file" class="hidden" accept="application/pdf">
                    </label>
                </div>

                <div class="grid gap-3 border-t border-slate-100 pt-4 sm:grid-cols-2">
                    <button
                        type="button"
                        @click="modalOpen = false"
                        class="rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                    >
                        Batal
                    </button>

                    <button
                        type="button"
                        class="rounded-xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                    >
                        Simpan & Publish
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection