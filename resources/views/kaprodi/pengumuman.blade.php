@extends('layouts.kaprodi')

@section('title', 'Pengumuman - Kaprodi')
@section('page-title', 'Pengumuman')

@php
    $activeMenu = 'pengumuman';

    $announcements = [
        [
            'id' => 'P1',
            'kategori' => 'Akademik',
            'title' => 'Jadwal Ujian Akhir Semester (UAS) Genap 2024/2025',
            'desc' => 'UAS semester genap akan dilaksanakan pada tanggal 9-20 Juni 2025. Mahasiswa wajib hadir tepat waktu.',
            'content' => 'Kepada seluruh mahasiswa Teknik Informatika, diberitahukan bahwa Ujian Akhir Semester (UAS) Genap 2024/2025 akan dilaksanakan pada tanggal 9 - 20 Juni 2025. Mahasiswa wajib hadir 15 menit sebelum ujian dimulai, membawa KTM, dan berpakaian rapi.',
            'date' => '20 Mei 2025',
            'file' => 'Jadwal_UAS_Genap_2025.pdf',
            'size' => '342 KB',
            'author' => 'Siti Rahma, S.Kom',
        ],
        [
            'id' => 'P2',
            'kategori' => 'Beasiswa',
            'title' => 'Pendaftaran Beasiswa Bidikmisi Tahap 2 Tahun 2025',
            'desc' => 'Pendaftaran beasiswa Bidikmisi tahap 2 dibuka mulai 1 Juni 2025. Segera lengkapi berkas persyaratan.',
            'content' => 'Pendaftaran Beasiswa Bidikmisi Tahap 2 Tahun 2025 dibuka untuk mahasiswa yang memenuhi persyaratan. Mahasiswa diharapkan membaca panduan resmi dan menyiapkan dokumen pendukung.',
            'date' => '15 Mei 2025',
            'file' => 'Pengumuman_Beasiswa_Bidikmisi_2025.pdf',
            'size' => '215 KB',
            'author' => 'Siti Rahma, S.Kom',
        ],
        [
            'id' => 'P3',
            'kategori' => 'Akademik',
            'title' => 'Pengumuman Wisuda Periode Agustus 2025',
            'desc' => 'Wisuda periode Agustus 2025 akan dilaksanakan pada 23 Agustus 2025. Pendaftaran dibuka mulai 1 Juli 2025.',
            'content' => 'Wisuda periode Agustus 2025 akan dilaksanakan pada 23 Agustus 2025. Pendaftaran dibuka mulai 1 Juli 2025.',
            'date' => '10 Mei 2025',
            'file' => null,
            'size' => null,
            'author' => 'Siti Rahma, S.Kom',
        ],
        [
            'id' => 'P4',
            'kategori' => 'Akademik',
            'title' => 'Pengisian KRS Online Semester Ganjil 2025/2026',
            'desc' => 'Pengisian KRS semester ganjil 2025/2026 dimulai 15 Juni 2025. Konsultasikan dengan dosen wali terlebih dahulu.',
            'content' => 'Pengisian KRS semester ganjil 2025/2026 dimulai 15 Juni 2025. Mahasiswa wajib konsultasi dengan dosen wali.',
            'date' => '5 Mei 2025',
            'file' => null,
            'size' => null,
            'author' => 'Siti Rahma, S.Kom',
        ],
        [
            'id' => 'P5',
            'kategori' => 'Kemahasiswaan',
            'title' => 'Informasi Pelaksanaan PKL dan Magang Semester Genap',
            'desc' => 'PKL dan magang semester genap dapat dilaksanakan mulai 1 Juli 2025. Segera ajukan surat pengantar.',
            'content' => 'PKL dan magang semester genap dapat dilaksanakan mulai 1 Juli 2025. Mahasiswa dapat mengajukan surat pengantar melalui sistem SIERA.',
            'date' => '28 April 2025',
            'file' => null,
            'size' => null,
            'author' => 'Siti Rahma, S.Kom',
        ],
    ];
@endphp

@section('content')
<div
    x-data="{
        mode: 'list',
        search: '',
        selected: null,
        announcements: @js($announcements),

        get filteredAnnouncements() {
            const keyword = this.search.toLowerCase();
            return this.announcements.filter(item =>
                item.title.toLowerCase().includes(keyword) ||
                item.desc.toLowerCase().includes(keyword) ||
                item.kategori.toLowerCase().includes(keyword)
            );
        },

        openDetail(item) {
            this.selected = item;
            this.mode = 'detail';
        },

        backToList() {
            this.mode = 'list';
            this.selected = null;
        }
    }"
>
    <template x-if="mode === 'list'">
        <div>
            <p class="mb-4 text-sm text-slate-600">
                <b>{{ count($announcements) }}</b> total pengumuman
            </p>

            <div class="mb-5">
                <div class="relative">
                    <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">⌕</span>
                    <input
                        type="text"
                        x-model="search"
                        placeholder="Cari pengumuman..."
                        class="h-11 w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-sm outline-none focus:border-violet-500 focus:ring-4 focus:ring-violet-100"
                    >
                </div>
            </div>

            <section class="space-y-4">
                <template x-for="item in filteredAnnouncements" :key="item.id">
                    <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        <div class="flex items-start gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-violet-100 text-violet-600">
                                📣
                            </div>

                            <div class="min-w-0 flex-1">
                                <div class="mb-2 flex flex-wrap items-center gap-2">
                                    <span
                                        class="rounded-full px-3 py-1 text-xs font-semibold"
                                        :class="{
                                            'bg-blue-100 text-blue-600': item.kategori === 'Akademik',
                                            'bg-purple-100 text-purple-600': item.kategori === 'Beasiswa',
                                            'bg-emerald-100 text-emerald-600': item.kategori === 'Kemahasiswaan'
                                        }"
                                        x-text="item.kategori"
                                    ></span>

                                    <span class="text-sm text-slate-400" x-text="item.date"></span>
                                </div>

                                <h3 class="font-semibold text-slate-800" x-text="item.title"></h3>
                                <p class="mt-1 text-sm text-slate-500" x-text="item.desc"></p>

                                <template x-if="item.file">
                                    <div class="mt-4 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
                                        <div class="flex items-center justify-between">
                                            <div class="flex min-w-0 items-center gap-3">
                                                <span class="rounded-md bg-red-50 px-2 py-1 text-xs font-bold text-red-500">PDF</span>
                                                <span class="truncate text-sm text-slate-600" x-text="item.file"></span>
                                            </div>
                                            <div class="flex gap-3 text-xs font-semibold">
                                                <span class="text-slate-400" x-text="item.size"></span>
                                                <a href="#" class="text-violet-600">Unduh PDF</a>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <button
                                type="button"
                                @click="openDetail(item)"
                                class="shrink-0 text-sm font-semibold text-violet-600 hover:text-violet-700"
                            >
                                ⊙ Detail
                            </button>
                        </div>
                    </article>
                </template>
            </section>
        </div>
    </template>

    <template x-if="mode === 'detail'">
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-5 py-4">
                <button @click="backToList()" class="text-sm font-semibold text-violet-600">← Kembali</button>
                <span class="mx-3 text-slate-300">|</span>
                <span class="text-sm text-slate-400">Detail Pengumuman</span>
            </div>

            <div class="p-5">
                <div class="mb-4 flex flex-wrap items-center gap-3">
                    <span
                        class="rounded-full px-3 py-1 text-xs font-semibold"
                        :class="{
                            'bg-blue-100 text-blue-600': selected?.kategori === 'Akademik',
                            'bg-purple-100 text-purple-600': selected?.kategori === 'Beasiswa',
                            'bg-emerald-100 text-emerald-600': selected?.kategori === 'Kemahasiswaan'
                        }"
                        x-text="selected?.kategori"
                    ></span>

                    <span class="text-sm text-slate-400" x-text="selected?.date"></span>
                </div>

                <h3 class="text-2xl font-semibold text-slate-800" x-text="selected?.title"></h3>
                <p class="mt-5 min-h-[300px] text-sm leading-7 text-slate-600" x-text="selected?.content"></p>

                <template x-if="selected?.file">
                    <div class="mt-8 border-t border-slate-100 pt-5">
                        <h4 class="mb-4 font-semibold text-slate-700">Surat Resmi Terlampir</h4>

                        <div class="flex items-center justify-between rounded-xl border border-violet-100 bg-violet-50 px-4 py-3">
                            <div class="flex min-w-0 items-center gap-3">
                                <div class="rounded-lg bg-white px-3 py-2 text-xs font-bold text-red-500">PDF</div>
                                <div class="min-w-0">
                                    <p class="truncate font-semibold text-slate-700" x-text="selected?.file"></p>
                                    <p class="text-xs text-slate-400" x-text="selected?.size"></p>
                                </div>
                            </div>

                            <div class="ml-3 flex shrink-0 gap-3">
                                <a href="#" class="rounded-xl border border-violet-200 bg-white px-4 py-2 text-sm font-semibold text-violet-600">
                                    Lihat
                                </a>
                                <a href="#" class="rounded-xl bg-violet-600 px-4 py-2 text-sm font-semibold text-white">
                                    Unduh PDF
                                </a>
                            </div>
                        </div>

                        <p class="mt-5 text-sm text-slate-400">
                            Diterbitkan oleh <span x-text="selected?.author"></span>
                        </p>
                    </div>
                </template>
            </div>
        </section>
    </template>
</div>
@endsection