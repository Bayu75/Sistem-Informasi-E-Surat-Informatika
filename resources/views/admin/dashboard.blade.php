@extends('layouts.admin')

@section('title', 'Dashboard Admin TU - SIERA')
@section('page-title', 'Dashboard')

@php
    $activeMenu = 'dashboard';

    $stats = [
        [
            'label' => 'Total Pengajuan',
            'value' => $totalPengajuan,
            'desc' => 'Semua pengajuan',
            'color' => 'border-blue-500',
            'icon' => 'document',
        ],
        [
            'label' => 'Menunggu Verifikasi',
            'value' => $menungguVerifikasi,
            'desc' => 'Perlu diverifikasi',
            'color' => 'border-amber-500',
            'icon' => 'clock',
        ],
        [
            'label' => 'Sudah Diverifikasi',
            'value' => $sudahDiverifikasi,
            'desc' => 'Siap diteruskan',
            'color' => 'border-emerald-500',
            'icon' => 'check',
        ],
        [
            'label' => 'Pengumuman Aktif',
            'value' => $pengumumanAktif,
            'desc' => 'Pengumuman aktif',
            'color' => 'border-purple-500',
            'icon' => 'megaphone',
        ],
    ];
@endphp

@section('content')
<div
    x-data="{
        detailOpen: false,
        rejectOpen: false,
        selectedItem: null,

        rows: @js($pengajuanTerbaru),

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
    {{-- Welcome Banner --}}
    <section class="mb-6 rounded-2xl bg-gradient-to-r from-blue-700 to-blue-600 p-6 text-white shadow-sm">
        <p class="text-sm text-blue-100">Selamat datang,</p>
        <h3 class="mt-1 text-2xl font-semibold">{{ auth()->user()->adminTU->nama }}</h3>
        <p class="mt-2 text-sm text-blue-100">
            Terdapat
            <span class="font-semibold text-white">
                {{ $menungguVerifikasi }} pengajuan baru
            </span>
            yang menunggu verifikasi.
        </p>
    </section>

    {{-- Statistik --}}
    <section class="mb-6 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($stats as $stat)
            <div class="rounded-2xl border-2 {{ $stat['color'] }} bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-slate-500">{{ $stat['label'] }}</p>
                        <p class="mt-2 text-3xl font-semibold text-slate-800">{{ $stat['value'] }}</p>
                        <p class="mt-2 text-sm text-slate-400">{{ $stat['desc'] }}</p>
                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-500">
                        @if ($stat['icon'] === 'document')
                            <svg class="h-5 w-5 text-blue-600" viewBox="0 0 24 24" fill="none">
                                <path d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 2V8H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        @elseif ($stat['icon'] === 'clock')
                            <svg class="h-5 w-5 text-amber-600" viewBox="0 0 24 24" fill="none">
                                <path d="M12 8V12L15 15M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        @elseif ($stat['icon'] === 'check')
                            <svg class="h-5 w-5 text-emerald-600" viewBox="0 0 24 24" fill="none">
                                <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        @else
                            <svg class="h-5 w-5 text-purple-600" viewBox="0 0 24 24" fill="none">
                                <path d="M3 11L21 4V20L3 13V11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7 14V18C7 19.1046 7.89543 20 9 20H10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </section>

    {{-- Pengajuan Terbaru --}}
    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
            <h3 class="text-lg font-semibold text-slate-800">Pengajuan Terbaru</h3>

            <a href="/admin/pengajuan-masuk" class="inline-flex items-center gap-1 text-sm font-semibold text-blue-600 hover:text-blue-700">
                Lihat semua
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                    <path d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-left text-sm">
                <thead class="bg-slate-50 text-xs font-semibold text-slate-500">
                    <tr>
                        <th class="px-5 py-4">Mahasiswa</th>
                        <th class="px-5 py-4">NIM</th>
                        <th class="px-5 py-4">Jenis Surat</th>
                        <th class="px-5 py-4">Tanggal</th>
                        <th class="px-5 py-4">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    <template x-for="item in rows" :key="item.id">
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

                            <td class="px-5 py-4 flex justify-center">
                                <span
                                    class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-xs font-semibold"
                                    :class="{
                                        ' bg-amber-100 text-amber-700': item.status === 'Menunggu Verifikasi',
                                        ' bg-blue-100 text-blue-700': item.status === 'Diverifikasi Admin',
                                        ' bg-red-100 text-red-700': item.status === 'Ditolak Admin',
                                    }"
                                >
                                    <span x-text="item.status"></span>
                                </span>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </section>
@endsection