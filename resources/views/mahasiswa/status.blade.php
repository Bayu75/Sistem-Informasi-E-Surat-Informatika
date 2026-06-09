@extends('layouts.mahasiswa')

@section('title', 'Status Pengajuan - Portal Mahasiswa')
@section('page-title', 'Status Pengajuan')

@php
    $activeMenu = 'status';
@endphp

@section('content')
    <div class="mb-5 grid gap-3 sm:grid-cols-[220px_1fr]">
        <select class="h-11 rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-500 outline-none">
            <option>Semua Status</option>
            <option>Menunggu Verifikasi</option>
            <option>Diverifikasi Admin</option>
            <option>Diteruskan ke Kaprodi</option>
        </select>

        <div class="relative">
            <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">⌕</span>
            <input
                type="text"
                placeholder="Cari pengajuan..."
                class="h-11 w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-sm outline-none focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100"
            >
        </div>
    </div>

    <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-5 py-4">
            <div>
                <h3 class="font-semibold text-slate-800">Surat Keterangan Aktif Kuliah</h3>
                <p class="mt-1 text-sm text-slate-400">Diajukan: 20 Mei 2025</p>
            </div>

            <span class="rounded-full border border-amber-300 bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                ● Menunggu Verifikasi
            </span>
        </div>

        <div class="px-5 py-8">
            <div class="relative">
                <div class="absolute left-8 right-8 top-6 h-1 bg-slate-200"></div>

                <div class="relative grid grid-cols-4 gap-3 text-center">
                    <div>
                        <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-cyan-500 text-white ring-4 ring-cyan-100">
                            ⏱
                        </div>
                        <p class="mt-3 text-sm font-semibold text-cyan-600">Menunggu<br>Verifikasi</p>
                    </div>

                    <div>
                        <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full border border-slate-300 bg-white text-slate-400">
                            ✓
                        </div>
                        <p class="mt-3 text-sm font-semibold text-slate-400">Diverifikasi<br>Admin</p>
                    </div>

                    <div>
                        <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full border border-slate-300 bg-white text-slate-400">
                            ➤
                        </div>
                        <p class="mt-3 text-sm font-semibold text-slate-400">Diteruskan<br>ke Kaprodi</p>
                    </div>

                    <div>
                        <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full border border-slate-300 bg-white text-slate-400">
                            ✓
                        </div>
                        <p class="mt-3 text-sm font-semibold text-slate-400">Disetujui /<br>Ditolak</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 rounded-2xl border border-cyan-100 bg-cyan-50 p-4">
                <h4 class="font-semibold text-cyan-700">Menunggu Verifikasi</h4>
                <p class="mt-1 text-sm text-cyan-600">
                    Admin TU sedang memeriksa kelengkapan dokumen
                </p>
            </div>
        </div>
    </section>
@endsection