@extends('layouts.mahasiswa')

@section('title', 'Pengumuman - Portal Mahasiswa')
@section('page-title', 'Pengumuman')

@php
    $activeMenu = 'pengumuman';

    $announcements = $pengumuman->map(function ($item) {
        return [
            'id' => $item->id,
            'kategori' => $item->kategori,
            'title' => $item->judul,
            'desc' => $item->ringkasan,
            'content' => $item->isi,
            'date' => \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y'),
            'file' => $item->nama_file_asli,
            'size' => '',
        ];
    });
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

            return this.announcements.filter((item) => {
                return item.title.toLowerCase().includes(keyword)
                    || item.desc.toLowerCase().includes(keyword)
                    || item.kategori.toLowerCase().includes(keyword);
            });
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
            <div class="mb-5">
                <div class="relative">
                    <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                            <path d="M21 21L16.65 16.65M18 11C18 14.866 14.866 18 11 18C7.134 18 4 14.866 4 11C4 7.134 7.134 4 11 4C14.866 4 18 7.134 18 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </span>

                    <input
                        type="text"
                        x-model="search"
                        placeholder="Cari pengumuman..."
                        class="h-11 w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-11 pr-4 text-sm outline-none focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100"
                    >
                </div>
            </div>

            <section class="grid gap-4 xl:grid-cols-2">
                <template x-for="item in filteredAnnouncements" :key="item.id">
                    <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        <div class="mb-4 flex items-start justify-between gap-4">
                            <div class="flex items-center gap-2">
                                <span
                                    class="rounded-full px-3 py-1 text-xs font-semibold"
                                    :class="{
                                        'bg-blue-100 text-blue-600': item.kategori === 'Akademik',
                                        'bg-purple-100 text-purple-600': item.kategori === 'Beasiswa',
                                        'bg-emerald-100 text-emerald-600': item.kategori === 'Kemahasiswaan'
                                    }"
                                    x-text="item.kategori"
                                ></span>

                                <span class="text-xs text-slate-400">📎 Surat terlampir</span>
                            </div>

                            <span class="text-sm text-slate-400" x-text="item.date"></span>
                        </div>

                        <h3 class="font-semibold text-slate-800" x-text="item.title"></h3>
                        <p class="mt-2 text-sm text-slate-500" x-text="item.desc"></p>

                        <button
                            type="button"
                            @click="openDetail(item)"
                            class="mt-4 inline-flex items-center gap-1 text-sm font-semibold text-cyan-600 hover:text-cyan-700 cursor-pointer"
                        >
                            Baca selengkapnya
                            <span>›</span>
                        </button>
                    </article>
                </template>

                <div
                    x-show="filteredAnnouncements.length === 0"
                    class="rounded-2xl border border-slate-200 bg-white p-10 text-center text-sm text-slate-400 xl:col-span-2"
                >
                    Pengumuman tidak ditemukan.
                </div>
            </section>
        </div>
    </template>

    <template x-if="mode === 'detail'">
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-5 py-4">
                <button
                    type="button"
                    @click="backToList()"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-cyan-600 hover:text-cyan-700"
                >
                    ← Kembali
                </button>

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

                    <p
                        class="mt-5 whitespace-pre-line text-sm leading-7 text-slate-600"
                        x-text="selected?.content">
                    </p>
                <div class="mt-8 border-t border-slate-100 pt-5">
                    <h4 class="mb-4 font-semibold text-slate-700">Surat Resmi Terlampir</h4>

                    <div class="flex items-center justify-between rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
                        <div class="flex min-w-0 items-center gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-red-50 text-xs font-bold text-red-500">
                                PDF
                            </div>

                            <div class="min-w-0">
                                <p class="truncate font-semibold text-slate-700" x-text="selected?.file"></p>
                                <p class="text-xs text-slate-400" x-text="selected?.size"></p>
                            </div>
                        </div>

                        <div class="ml-3 flex shrink-0 gap-3">
                            <a
                                :href="`/mahasiswa/pengumuman/${selected.id}/lihat`"
                                target="_blank"
                                class="rounded-xl border border-cyan-200 bg-white px-4 py-2 text-sm font-semibold text-cyan-600"
                            >
                                Lihat
                            </a>

                            <a
                                :href="`/mahasiswa/pengumuman/${selected.id}/download`"
                                class="rounded-xl bg-cyan-600 px-4 py-2 text-sm font-semibold text-white"
                            >
                                Unduh
                            </a>
                        </div>
                    </div>

                    <p class="mt-5 text-sm text-slate-400">Diterbitkan oleh Siti Rahma, S.Kom</p>
                </div>
            </div>
        </section>
    </template>
</div>
@endsection
