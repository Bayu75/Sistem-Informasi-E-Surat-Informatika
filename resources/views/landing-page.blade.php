@extends('layouts.guest')

@section('title', 'SIERA')

@section('content')

{{-- Navbar --}}
<nav class="bg-white border-b border-slate-200 sticky top-0 z-50">

    <div class="max-w-7xl mx-auto px-6">

        <div class="h-16 flex items-center justify-between">

            {{-- Kiri --}}
            <div class="flex items-center gap-10">

                {{-- Logo --}}
                <a href="" class="flex items-center gap-2">

                    <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center">

                        {{-- Icon surat --}}
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-4 h-4 text-white"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M3 8l9 6 9-6m-18 8h18a2 2 0 002-2V8a2 2 0 00-2-2H3a2 2 0 00-2 2v6a2 2 0 002 2z" />
                        </svg>

                    </div>

                    <span class="font-semibold text-slate-800">
                        SIERA
                    </span>

                </a>

                {{-- Menu --}}
                <div class="hidden md:flex items-center gap-8">

                    <a href="#pengumuman"
                       class="text-sm text-slate-500 hover:text-blue-600 transition">
                        Pengumuman
                    </a>

                    <a href="#alur"
                       class="text-sm text-slate-500 hover:text-blue-600 transition">
                        Alur Pengajuan
                    </a>

                </div>

            </div>

            {{-- Kanan --}}
            <a href="/login"
               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-4 h-4"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M17 16l4-4m0 0l-4-4m4 4H7" />

                </svg>

                Masuk

            </a>

        </div>

    </div>

</nav>

{{-- Hero Section --}}
<section class="relative overflow-hidden bg-gradient-to-br from-blue-700 via-blue-800 to-indigo-900 text-white">

    <div class="max-w-6xl mx-auto px-6 pt-24 pb-40">

        <div class="text-center">

            {{-- Badge --}}
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/20 backdrop-blur-sm text-xs text-blue-100">

                Sistem resmi Program Studi Informatika

            </div>

            {{-- Heading --}}
            <h1
                class="mt-10 text-5xl md:text-6xl lg:text-7xl font-bold leading-tight">

                Kelola Surat Akademik

                <span class="block text-blue-300">
                    Mudah & Efisien
                </span>

            </h1>

            {{-- Description --}}
            <p
                class="mt-8 max-w-2xl mx-auto text-lg text-blue-100 leading-relaxed">

                SIERA hadir untuk mempermudah proses pengajuan surat akademik
                secara digital kapan saja, di mana saja, tanpa antre.

            </p>

            {{-- CTA --}}
            <div
                class="mt-10 flex flex-col sm:flex-row justify-center gap-4">

                <a href="/login"
                   class="inline-flex items-center justify-center gap-2 bg-white text-blue-700 px-6 py-3 rounded-xl font-semibold shadow-lg hover:scale-105 transition">

                    Masuk ke Sistem

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 5l7 7-7 7"/>

                    </svg>

                </a>

                <a href="#alur"
                   class="inline-flex items-center justify-center px-6 py-3 rounded-xl border border-white/20 bg-white/10 backdrop-blur-sm hover:bg-white/20 transition">

                    Pelajari Alur Pengajuan

                </a>

            </div>

            {{-- Statistik --}}
            <div
                class="mt-16 max-w-3xl mx-auto bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl overflow-hidden">

                <div class="grid grid-cols-2 md:grid-cols-3">

                    <div class="py-6 border-r border-white/10">
                        <div class="text-3xl font-bold">7</div>
                        <div class="text-sm text-blue-100 mt-1">
                            Jenis Surat
                        </div>
                    </div>

                    <div class="py-6 border-r border-white/10">
                        <div class="text-3xl font-bold">2–3</div>
                        <div class="text-sm text-blue-100 mt-1">
                            Hari Kerja
                        </div>
                    </div>

                    <div class="py-6">
                        <div class="text-3xl font-bold">100%</div>
                        <div class="text-sm text-blue-100 mt-1">
                            Digital
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Wave Bottom --}}
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none">

        <svg
            class="relative block w-full h-24"
            xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="none"
            viewBox="0 0 1200 120">

            <path
                d="M0,64 C300,120 900,0 1200,64 L1200,120 L0,120 Z"
                fill="#ffffff">
            </path>

        </svg>

    </div>

</section>

{{-- Pengumuman Terbaru --}}
<section id="pengumuman" class="bg-white py-24">

    <div class="max-w-5xl mx-auto px-6">

        {{-- Badge --}}
        <div class="flex justify-center">

            <span
                class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-50 text-blue-600 text-xs font-medium">

                Informasi Terkini

            </span>

        </div>

        {{-- Heading --}}
        <div class="text-center mt-6">

            <h2 class="text-4xl font-bold text-slate-900">
                Pengumuman Terbaru
            </h2>

            <p class="mt-3 text-slate-500">
                Informasi dan pemberitahuan resmi terbaru dari Program Studi Informatika
            </p>

        </div>

        {{-- Grid --}}
        <div class="grid md:grid-cols-3 gap-4 mt-14">

            @forelse($pengumuman as $item)

                <div class="bg-white border border-slate-200 rounded-2xl p-5">

                    <div class="flex gap-2">

                        <span
                            class="px-3 py-1 rounded-full text-xs
                            @switch($item->kategori)
                                @case('Akademik')
                                    bg-blue-100 text-blue-600
                                    @break

                                @case('Beasiswa')
                                    bg-purple-100 text-purple-600
                                    @break

                                @case('Kemahasiswaan')
                                    bg-green-100 text-green-600
                                    @break

                                @default
                                    bg-slate-100 text-slate-600
                            @endswitch">

                            {{ $item->kategori }}

                        </span>

                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-600 text-xs">
                            {{ $item->status }}
                        </span>

                    </div>

                    <h3 class="mt-4 text-base font-semibold text-slate-900 leading-snug">
                        {{ $item->judul }}
                    </h3>

                    <p class="mt-3 text-sm text-slate-500 leading-relaxed">
                        {{ $item->ringkasan }}
                    </p>

                    <div class="mt-4 border-t border-slate-100 pt-4 flex justify-between items-center">

                        <span class="text-xs text-slate-400">
                            📅 {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                        </span>

                        <a href="{{ route('login') }}"
                        class="text-blue-600 text-sm font-medium">
                            Baca Selengkapnya →
                        </a>

                    </div>

                </div>

            @empty

                <div class="col-span-3 text-center py-8 text-slate-500">
                    Belum ada pengumuman.
                </div>

            @endforelse

        </div>

        {{-- Button --}}
        <div class="flex justify-center mt-10">

            <a href="/login"
                class="px-6 py-3 border border-blue-200 rounded-xl text-blue-600 text-sm font-medium hover:bg-blue-50 transition">

                Lihat Semua Pengumuman →

            </a>

        </div>

    </div>

</section>

{{-- Alur Pengajuan Surat --}}
<section id="alur" class="bg-slate-50 py-24">

    <div class="max-w-6xl mx-auto px-6">

        {{-- Badge --}}
        <div class="flex justify-center">

            <span
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-50 text-indigo-600 text-xs font-medium">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-3 h-3"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />

                </svg>

                Estimasi 2–3 Hari Kerja

            </span>

        </div>

        {{-- Heading --}}
        <div class="text-center mt-6">

            <h2 class="text-4xl font-bold text-slate-900">
                Alur Pengajuan Surat
            </h2>

            <p class="mt-4 text-slate-500 max-w-xl mx-auto">
                Proses pengajuan surat akademik yang mudah, transparan,
                dan dapat dipantau secara real-time
            </p>

        </div>

        {{-- Steps --}}
        <div class="grid md:grid-cols-4 gap-4 mt-14">

            {{-- Step 1 --}}
            <div class="relative bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">

                <div class="absolute top-5 right-5 text-3xl font-bold text-slate-100">
                    01
                </div>

                <div class="w-12 h-12 rounded-xl bg-blue-500 flex items-center justify-center">
                    <span class="text-white font-bold text-lg">1</span>
                </div>

                <h3 class="mt-4 font-semibold text-slate-900">
                    Pengajuan Surat
                </h3>

                <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                    Mahasiswa memilih jenis surat dan mengisi formulir pengajuan.
                </p>

            </div>

            {{-- Step 2 --}}
            <div class="relative bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">

                <div class="absolute top-5 right-5 text-3xl font-bold text-slate-100">
                    02
                </div>

                <div class="w-12 h-12 rounded-xl bg-indigo-500 flex items-center justify-center">
                    <span class="text-white font-bold text-lg">2</span>
                </div>

                <h3 class="mt-4 font-semibold text-slate-900">
                    Verifikasi Administrasi
                </h3>

                <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                    Admin TU memeriksa kelengkapan data dan dokumen.
                </p>

            </div>

            {{-- Step 3 --}}
            <div class="relative bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">

                <div class="absolute top-5 right-5 text-3xl font-bold text-slate-100">
                    03
                </div>

                <div class="w-12 h-12 rounded-xl bg-purple-500 flex items-center justify-center">
                    <span class="text-white font-bold text-lg">3</span>
                </div>

                <h3 class="mt-4 font-semibold text-slate-900">
                    Persetujuan Kaprodi
                </h3>

                <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                    Kaprodi meninjau dan memberikan persetujuan.
                </p>

            </div>

            {{-- Step 4 --}}
            <div class="relative bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">

                <div class="absolute top-5 right-5 text-3xl font-bold text-slate-100">
                    04
                </div>

                <div class="w-12 h-12 rounded-xl bg-green-500 flex items-center justify-center">
                    <span class="text-white font-bold text-lg">4</span>
                </div>

                <h3 class="mt-4 font-semibold text-slate-900">
                    Unduh Surat
                </h3>

                <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                    Surat selesai diproses dan dapat diunduh secara digital.
                </p>

            </div>

        </div>

        {{-- Info Card --}}
        <div
            class="mt-10 mb-10 bg-blue-50 border border-blue-200 rounded-2xl p-4 flex flex-col md:flex-row items-center justify-between gap-4">

            <div class="flex items-center gap-4">

                <div
                    class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600">

                    ⏱

                </div>

                <div>

                    <h4 class="font-semibold text-blue-700">
                        Estimasi Waktu Penyelesaian
                    </h4>

                    <p class="text-sm text-blue-600">
                        2–3 hari kerja setelah dokumen dinyatakan lengkap
                    </p>

                </div>

            </div>

            <a href="/login"
               class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition">

                Ajukan Surat Sekarang

                →
            </a>

        </div>

    </div>

</section>

{{-- Footer --}}
<footer class="bg-slate-950 text-white py-8">

    <div class="max-w-6xl mx-auto px-6">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            {{-- Kiri --}}
            <div>
                <h3 class="font-semibold text-base">
                    SIERA
                </h3>

                <p class="text-sm text-slate-400">
                    Sistem Informasi E-Surat Informatika
                </p>
            </div>

            {{-- Kanan --}}
            <div class="text-sm text-slate-400 md:text-right">
                © {{ date('Y') }} Universitas Udayana
            </div>

        </div>

    </div>

</footer>

@endsection