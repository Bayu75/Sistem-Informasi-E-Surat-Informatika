@extends('layouts.kaprodi')

@section('title', 'Persetujuan Pengajuan - Kaprodi')
@section('page-title', 'Persetujuan Pengajuan')

@php
    $activeMenu = 'persetujuan';

    $items = [
        [
            'id' => 'S3',
            'nama' => 'Rizky Pratama',
            'nim' => '2020015',
            'prodi' => 'Teknik Informatika',
            'jenis' => 'Surat Permohonan Beasiswa',
            'keperluan' => 'Beasiswa prestasi akademik semester ganjil 2024/2025',
            'tanggal' => '15 Mei 2025',
            'status' => 'Diteruskan ke Kaprodi',
            'catatan_admin' => 'Semua dokumen telah diverifikasi. Diteruskan ke Kaprodi.',
            'file_surat' => 'Surat_Permohonan_Beasiswa_Rizky.pdf',
            'dokumen' => ['KTM.pdf', 'Transkrip_Nilai.pdf', 'Sertifikat_Prestasi.pdf'],
            'syarat' => [
                ['nama' => 'KTM (Kartu Tanda Mahasiswa)', 'status' => 'lengkap'],
                ['nama' => 'Transkrip Nilai Terbaru', 'status' => 'lengkap'],
                ['nama' => 'Sertifikat Prestasi (jika ada)', 'status' => 'lengkap'],
                ['nama' => 'Surat Keterangan Tidak Mampu (jika diperlukan)', 'status' => 'kurang'],
            ],
        ],
    ];
@endphp

@section('content')
<div
    x-data="{
        search: '',
        detailOpen: false,
        approveOpen: false,
        rejectOpen: false,
        selectedItem: null,
        items: @js($items),

        get filteredItems() {
            const keyword = this.search.toLowerCase();
            return this.items.filter(item =>
                item.nama.toLowerCase().includes(keyword) ||
                item.nim.toLowerCase().includes(keyword) ||
                item.jenis.toLowerCase().includes(keyword)
            );
        },

        openDetail(item) {
            this.selectedItem = item;
            this.detailOpen = true;
        },

        openApprove(item) {
            this.selectedItem = item;
            this.approveOpen = true;
        },

        openReject(item) {
            this.selectedItem = item;
            this.rejectOpen = true;
        },

        closeAll() {
            this.detailOpen = false;
            this.approveOpen = false;
            this.rejectOpen = false;
        }
    }"
>
    <section class="mb-5 rounded-2xl border border-violet-300 bg-violet-50 px-5 py-4">
        <div class="flex items-start gap-3">
            <div class="text-violet-600">▣</div>
            <div>
                <h3 class="font-semibold text-violet-700">
                    1 pengajuan diteruskan oleh Admin TU — menunggu keputusan Anda
                </h3>
                <p class="text-sm text-violet-600">
                    Pengajuan ini telah diverifikasi kelengkapan dokumennya. Silakan tinjau detail dan ambil keputusan.
                </p>
            </div>
        </div>
    </section>

    <div class="mb-5">
        <div class="relative">
            <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">⌕</span>
            <input
                type="text"
                x-model="search"
                placeholder="Cari pengajuan..."
                class="h-11 w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-sm outline-none focus:border-violet-500 focus:ring-4 focus:ring-violet-100"
            >
        </div>
    </div>

    <section class="space-y-4">
        <template x-for="item in filteredItems" :key="item.id">
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="mb-4 flex items-start justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-violet-100 font-bold text-violet-600" x-text="item.nama.charAt(0)"></span>
                        <div>
                            <h3 class="font-semibold text-slate-800" x-text="item.nama"></h3>
                            <p class="text-sm text-slate-500">
                                NIM: <span x-text="item.nim"></span> · <span x-text="item.prodi"></span>
                            </p>
                        </div>
                    </div>

                    <span class="rounded-full border border-violet-300 bg-violet-50 px-3 py-1 text-xs font-semibold text-violet-700">
                        ● Diteruskan ke Kaprodi
                    </span>
                </div>

                <div class="grid gap-3 lg:grid-cols-2">
                    <div class="rounded-xl bg-slate-50 p-4">
                        <p class="text-sm text-slate-400">Jenis Surat</p>
                        <p class="font-semibold text-slate-700" x-text="item.jenis"></p>
                    </div>

                    <div class="rounded-xl bg-slate-50 p-4">
                        <p class="text-sm text-slate-400">Keperluan</p>
                        <p class="font-semibold text-slate-700" x-text="item.keperluan"></p>
                    </div>
                </div>

                <div class="mt-3 rounded-xl bg-blue-50 p-4">
                    <p class="text-sm font-bold text-blue-600">Catatan Admin TU</p>
                    <p class="text-sm text-slate-600" x-text="item.catatan_admin"></p>
                </div>

                <div class="mt-4 grid gap-3 sm:grid-cols-[1fr_1fr_auto]">
                    <button
                        type="button"
                        @click="openApprove(item)"
                        class="rounded-xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-emerald-700"
                    >
                        ✓ Setujui
                    </button>

                    <button
                        type="button"
                        @click="openReject(item)"
                        class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-600 transition hover:bg-red-100"
                    >
                        ⊗ Tolak
                    </button>

                    <button
                        type="button"
                        @click="openDetail(item)"
                        class="rounded-xl border border-slate-200 px-4 py-3 text-slate-500 transition hover:bg-slate-50"
                    >
                        ⊙
                    </button>
                </div>
            </article>
        </template>
    </section>

    {{-- Detail Modal --}}
    <div
        x-show="detailOpen"
        x-transition.opacity
        class="fixed inset-0 z-[60] flex items-center justify-center bg-slate-900/50 px-4 py-6"
        style="display: none;"
    >
        <div
            @click.outside="closeAll()"
            class="max-h-[92vh] w-full max-w-2xl overflow-y-auto rounded-2xl bg-white shadow-2xl"
        >
            <div class="flex items-start justify-between border-b border-slate-100 px-5 py-4">
                <div>
                    <h3 class="text-xl font-semibold text-slate-800">Detail Pengajuan Surat</h3>
                    <p class="text-sm text-slate-400">ID: <span x-text="selectedItem?.id"></span></p>
                </div>

                <button @click="closeAll()" class="text-2xl text-slate-400">&times;</button>
            </div>

            <div class="space-y-4 p-5" x-show="selectedItem">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-500">Status saat ini:</span>
                    <span class="rounded-full border border-violet-300 bg-violet-50 px-3 py-1 text-xs font-semibold text-violet-700">
                        ● Diteruskan ke Kaprodi
                    </span>
                </div>

                <div class="rounded-2xl bg-slate-50 p-4">
                    <h4 class="mb-4 font-semibold text-slate-700">Informasi Mahasiswa</h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between"><span class="text-slate-500">Nama</span><b x-text="selectedItem?.nama"></b></div>
                        <div class="flex justify-between"><span class="text-slate-500">NIM</span><b x-text="selectedItem?.nim"></b></div>
                        <div class="flex justify-between"><span class="text-slate-500">Program Studi</span><b x-text="selectedItem?.prodi"></b></div>
                    </div>
                </div>

                <div class="rounded-2xl bg-slate-50 p-4">
                    <h4 class="mb-4 font-semibold text-slate-700">Informasi Surat</h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between gap-4"><span class="text-slate-500">Jenis Surat</span><b class="text-right" x-text="selectedItem?.jenis"></b></div>
                        <div class="flex justify-between gap-4"><span class="text-slate-500">Keperluan</span><b class="max-w-sm text-right" x-text="selectedItem?.keperluan"></b></div>
                        <div class="flex justify-between gap-4"><span class="text-slate-500">Tanggal Pengajuan</span><b x-text="selectedItem?.tanggal"></b></div>
                    </div>
                </div>

                <div>
                    <h4 class="mb-3 text-sm font-semibold text-slate-700">Dokumen Pendukung yang Seharusnya Dilampirkan</h4>
                    <div class="rounded-xl border border-amber-300 bg-amber-50 p-4 text-xs font-semibold">
                        <template x-for="syarat in selectedItem?.syarat" :key="syarat.nama">
                            <p
                                class="mb-2 flex items-center gap-2 last:mb-0"
                                :class="syarat.status === 'lengkap' ? 'text-emerald-600' : 'text-amber-600'"
                            >
                                <span
                                    class="flex h-4 w-4 items-center justify-center rounded-full text-[10px] text-white"
                                    :class="syarat.status === 'lengkap' ? 'bg-emerald-500' : 'bg-amber-400'"
                                    x-text="syarat.status === 'lengkap' ? '✓' : '!'"
                                ></span>
                                <span x-text="syarat.nama"></span>
                            </p>
                        </template>
                    </div>
                </div>

                <div>
                    <h4 class="mb-3 text-sm font-semibold text-slate-700">File Surat Pengajuan</h4>
                    <div class="flex items-center justify-between rounded-xl border border-violet-200 bg-violet-50 px-4 py-3">
                        <p class="font-semibold text-slate-700" x-text="selectedItem?.file_surat"></p>
                        <div class="flex gap-3 text-xs font-semibold">
                            <a href="#" class="text-violet-600">Lihat</a>
                            <a href="#" class="text-slate-500">Unduh</a>
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="mb-3 text-sm font-semibold text-slate-700">Dokumen Pendukung yang Dilampirkan</h4>
                    <div class="space-y-2">
                        <template x-for="dokumen in selectedItem?.dokumen" :key="dokumen">
                            <div class="flex items-center justify-between rounded-xl border border-slate-200 px-4 py-3">
                                <span x-text="dokumen"></span>
                                <a href="#" class="text-xs font-semibold text-violet-600">Lihat</a>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="rounded-xl bg-blue-50 p-4">
                    <p class="text-xs font-bold text-blue-600">Catatan Admin TU</p>
                    <p class="text-sm text-slate-600" x-text="selectedItem?.catatan_admin"></p>
                </div>

                <div class="grid gap-3 border-t border-slate-100 pt-4 sm:grid-cols-2">
                    <button @click="detailOpen = false; approveOpen = true" class="rounded-xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white">✓ Setujui</button>
                    <button @click="detailOpen = false; rejectOpen = true" class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-600">⊗ Tolak</button>
                </div>

                <button @click="closeAll()" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    {{-- Approve Modal --}}
    <div
        x-show="approveOpen"
        x-transition.opacity
        class="fixed inset-0 z-[70] flex items-center justify-center bg-slate-900/50 px-4"
        style="display: none;"
    >
        <div @click.outside="closeAll()" class="w-full max-w-lg rounded-2xl bg-white shadow-2xl">
            <div class="flex items-center justify-between border-b border-slate-100 p-5">
                <div class="flex items-center gap-3">
                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">✓</span>
                    <h3 class="text-xl font-semibold text-slate-800">Setujui Pengajuan</h3>
                </div>
                <button @click="closeAll()" class="text-2xl text-slate-400">&times;</button>
            </div>

            <div class="space-y-4 p-5">
                <div class="rounded-xl bg-slate-50 p-4 text-sm">
                    <p class="text-slate-400">Mahasiswa</p>
                    <p class="font-semibold text-slate-700">
                        <span x-text="selectedItem?.nama"></span> — <span x-text="selectedItem?.jenis"></span>
                    </p>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-600">Catatan Persetujuan <span class="text-slate-400">(opsional)</span></label>
                    <textarea rows="4" placeholder="Tambahkan catatan persetujuan..." class="w-full rounded-xl border border-slate-200 p-4 text-sm outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100"></textarea>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-600">Tanggal Kadaluwarsa Surat <span class="text-slate-400">(opsional)</span></label>
                    <input type="date" class="h-11 w-full rounded-xl border border-slate-200 px-4 text-sm outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100">
                    <p class="mt-2 text-xs text-slate-400">ⓘ Jika tidak diisi, surat tidak memiliki tanggal kadaluwarsa.</p>
                </div>

                <div class="grid gap-3 pt-2 sm:grid-cols-2">
                    <button @click="closeAll()" class="rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600">Batal</button>
                    <button class="rounded-xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white">✓ Konfirmasi Setujui</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Reject Modal --}}
    <div
        x-show="rejectOpen"
        x-transition.opacity
        class="fixed inset-0 z-[70] flex items-center justify-center bg-slate-900/50 px-4"
        style="display: none;"
    >
        <div @click.outside="closeAll()" class="w-full max-w-lg rounded-2xl bg-white shadow-2xl">
            <div class="flex items-center justify-between border-b border-slate-100 p-5">
                <div class="flex items-center gap-3">
                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-red-100 text-red-600">⊗</span>
                    <h3 class="text-xl font-semibold text-slate-800">Tolak Pengajuan</h3>
                </div>
                <button @click="closeAll()" class="text-2xl text-slate-400">&times;</button>
            </div>

            <div class="space-y-4 p-5">
                <div class="rounded-xl bg-slate-50 p-4 text-sm">
                    <p class="text-slate-400">Mahasiswa</p>
                    <p class="font-semibold text-slate-700">
                        <span x-text="selectedItem?.nama"></span> — <span x-text="selectedItem?.jenis"></span>
                    </p>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-600">Alasan Penolakan <span class="text-red-500">(wajib)</span></label>
                    <textarea rows="4" placeholder="Jelaskan alasan penolakan..." class="w-full rounded-xl border border-red-200 p-4 text-sm outline-none focus:border-red-400 focus:ring-4 focus:ring-red-100"></textarea>
                </div>

                <div class="grid gap-3 pt-2 sm:grid-cols-2">
                    <button @click="closeAll()" class="rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600">Batal</button>
                    <button class="rounded-xl bg-red-600 px-4 py-3 text-sm font-semibold text-white">⊗ Konfirmasi Tolak</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection