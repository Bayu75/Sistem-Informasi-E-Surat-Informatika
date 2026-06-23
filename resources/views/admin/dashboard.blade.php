@extends('layouts.admin')

@section('title', 'Dashboard Admin TU - SIERA')
@section('page-title', 'Dashboard')

@php
    $activeMenu = 'dashboard';

    $stats = [
        [
            'label' => 'Total Pengajuan',
            'value' => 9,
            'desc' => 'Semua pengajuan',
            'color' => 'border-blue-500',
            'icon' => 'document',
        ],
        [
            'label' => 'Menunggu Verifikasi',
            'value' => 2,
            'desc' => 'Perlu diverifikasi',
            'color' => 'border-amber-500',
            'icon' => 'clock',
        ],
        [
            'label' => 'Sudah Diverifikasi',
            'value' => 2,
            'desc' => 'Siap diteruskan',
            'color' => 'border-emerald-500',
            'icon' => 'check',
        ],
        [
            'label' => 'Pengumuman Aktif',
            'value' => 4,
            'desc' => 'Pengumuman aktif',
            'color' => 'border-purple-500',
            'icon' => 'megaphone',
        ],
    ];

    $rows = [
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
            'id' => 'S1B',
            'nama' => 'Budi Santoso',
            'nim' => '2021001',
            'jenis' => 'Surat Dispensasi',
            'keperluan' => 'Mengikuti kegiatan organisasi kampus di luar kota',
            'tanggal' => '10 Mei 2025',
            'status' => 'Ditolak',
            'file_surat' => 'Surat_Dispensasi_Budi.pdf',
            'dokumen' => ['KTM.pdf', 'Surat_Kegiatan.pdf'],
            'syarat' => [
                ['nama' => 'KTM (Kartu Tanda Mahasiswa)', 'status' => 'lengkap'],
                ['nama' => 'Surat Resmi Kegiatan', 'status' => 'lengkap'],
                ['nama' => 'Jadwal Kegiatan', 'status' => 'kurang'],
            ],
        ],
        [
            'id' => 'S2',
            'nama' => 'Dewi Rahayu',
            'nim' => '2021002',
            'jenis' => 'Surat Pengantar PKL/Magang',
            'keperluan' => 'Magang di PT Teknologi Nusantara selama 3 bulan',
            'tanggal' => '18 Mei 2025',
            'status' => 'Diverifikasi Admin',
            'file_surat' => 'Surat_PKL_Dewi_Rahayu.pdf',
            'dokumen' => ['KTM.pdf', 'Proposal_PKL.pdf', 'Surat_Perusahaan.pdf'],
            'syarat' => [
                ['nama' => 'KTM (Kartu Tanda Mahasiswa)', 'status' => 'lengkap'],
                ['nama' => 'Proposal PKL/Magang', 'status' => 'lengkap'],
                ['nama' => 'Surat Penerimaan dari Perusahaan/Instansi', 'status' => 'kurang'],
            ],
        ],
        [
            'id' => 'S8',
            'nama' => 'Rizky Pratama',
            'nim' => '2020015',
            'jenis' => 'Surat Permohonan Beasiswa',
            'keperluan' => 'Pengajuan beasiswa prestasi akademik',
            'tanggal' => '15 Mei 2025',
            'status' => 'Diteruskan ke Kaprodi',
            'file_surat' => 'Surat_Beasiswa_Rizky.pdf',
            'dokumen' => ['KTM.pdf', 'Transkrip_Nilai.pdf', 'Sertifikat_Prestasi.pdf'],
            'syarat' => [
                ['nama' => 'KTM (Kartu Tanda Mahasiswa)', 'status' => 'lengkap'],
                ['nama' => 'Transkrip Nilai', 'status' => 'lengkap'],
                ['nama' => 'Sertifikat Prestasi', 'status' => 'lengkap'],
            ],
        ],
        [
            'id' => 'S4',
            'nama' => 'Anisa Putri',
            'nim' => '2020020',
            'jenis' => 'Surat Keterangan Aktif Kuliah',
            'keperluan' => 'Pengajuan pinjaman KPR Bank Mandiri atas nama orang tua',
            'tanggal' => '10 Mei 2025',
            'status' => 'Disetujui',
            'file_surat' => 'Surat_Keterangan_Aktif_Anisa.pdf',
            'dokumen' => ['KTM.pdf', 'KRS_Semester_10.pdf'],
            'syarat' => [
                ['nama' => 'KTM (Kartu Tanda Mahasiswa)', 'status' => 'lengkap'],
                ['nama' => 'KRS Semester Terbaru', 'status' => 'lengkap'],
                ['nama' => 'Bukti Pembayaran UKT', 'status' => 'kurang'],
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

        rows: @js($rows),

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
            Terdapat <span class="font-semibold text-white">2 pengajuan baru</span> yang menunggu verifikasi.
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
                        <th class="px-5 py-4">Aksi</th>
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

                {{-- Footer --}}
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