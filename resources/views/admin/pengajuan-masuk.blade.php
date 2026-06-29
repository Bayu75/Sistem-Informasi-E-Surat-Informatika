@extends('layouts.admin')

@section('title', 'Pengajuan Masuk - Admin TU')
@section('page-title', 'Pengajuan Masuk')

@php
    $activeMenu = 'pengajuan-masuk';
@endphp

@section('content')
<div
    x-data="{
        detailOpen: false,
        rejectOpen: false,

        search: '',
        jenis: '',
        status: '',
        sort: 'terbaru',

        selectedItem: null,

        items: @js($pengajuan),

        get filteredItems() {
            let result = this.items.filter(item => {

                const keyword = this.search.toLowerCase();

                const nama =
                    item.mahasiswa?.nama?.toLowerCase() || '';

                const nim =
                    item.mahasiswa?.nim?.toLowerCase() || '';

                const jenis =
                    item.jenis_surat?.nama_surat || '';

                const matchSearch =
                    nama.includes(keyword) ||
                    nim.includes(keyword);

                const matchJenis =
                    this.jenis === '' ||
                    jenis === this.jenis;

                const matchStatus =
                    this.status === '' ||
                    item.status === this.status;

                return matchSearch &&
                    matchJenis &&
                    matchStatus;
            });

            if (this.sort === 'nama_az') {
                result.sort((a, b) =>
                    a.mahasiswa.nama.localeCompare(b.mahasiswa.nama)
                );
            }

            if (this.sort === 'nama_za') {
                result.sort((a, b) =>
                    b.mahasiswa.nama.localeCompare(a.mahasiswa.nama)
                );
            }

            if (this.sort === 'terbaru') {
                result.sort((a, b) =>
                    new Date(b.created_at) -
                    new Date(a.created_at)
                );
            }

            if (this.sort === 'terlama') {
                result.sort((a, b) =>
                    new Date(a.created_at) -
                    new Date(b.created_at)
                );
            }

            return result;
        },

        resetFilter() {
            this.search = '';
            this.jenis = '';
            this.status = '';
            this.sort = 'terbaru';
        },

        openDetail(item) {
            this.selectedItem = item;
            this.rejectOpen = false;
            this.detailOpen = true;
        },

        openReject() {
            this.detailOpen = false;
            this.rejectOpen = true;
        }
    }"
>
    {{-- Filter --}}
    <section class="mb-4 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
        <div class="grid gap-3 xl:grid-cols-[1fr_250px_150px_150px_100px]">
            {{-- Search --}}
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
                    placeholder="Cari nama mahasiswa atau NIM..."
                    class="h-11 w-full rounded-xl border border-slate-200 pl-11 pr-4 text-sm focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                >
            </div>

            {{-- Jenis Surat --}}
            <select
                x-model="jenis"
                class="h-11 rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
            >
                <option value="">Semua Jenis Surat</option>

                @foreach($jenisSurat as $jenis)
                    <option value="{{ $jenis->nama_surat }}">
                        {{ $jenis->nama_surat }}
                    </option>
                @endforeach
            </select>

            {{-- Status --}}
            <select
                x-model="status"
                class="h-11 rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
            >
                <option value="">Semua Status</option>
                <option value="menunggu_verifikasi">Menunggu Verifikasi</option>
                <option value="diverifikasi_admin">Diverifikasi Admin</option>
                <option value="ditolak_admin">Ditolak Admin</option>
            </select>

            {{-- Sort --}}
            <select
                x-model="sort"
                class="h-11 rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
            >
                <option value="terbaru">Terbaru Dulu</option>
                <option value="terlama">Terlama Dulu</option>
            </select>

            {{-- Reset --}}
            <button
                type="button"
                @click="resetFilter()"
                class="inline-flex h-11 items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 text-sm font-medium text-slate-400 transition hover:bg-slate-50 hover:text-slate-600"
            >
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M4 4V10H10M20 20V14H14M19 9A7 7 0 0 0 6.34 6.34L4 10M20 14L17.66 17.66A7 7 0 0 1 5 15"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
                Reset
            </button>
        </div>

        <div class="mt-3 border-t border-slate-100 pt-3">
            <p class="text-xs text-slate-500">
                Menampilkan
                <b x-text="filteredItems.length"></b>
                dari
                <b x-text="items.length"></b>
                pengajuan
            </p>
        </div>
    </section>

    {{-- Table --}}
    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[1000px] text-left text-sm">
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
                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-5 py-4">
                                <div
                                    class="font-medium text-slate-700"
                                    x-text="item.mahasiswa.nama"
                                ></div>
                            </td>

                            <td
                                class="px-5 py-4 text-slate-600"
                                x-text="item.mahasiswa.nim"
                            ></td>

                            <td
                                class="px-5 py-4 text-slate-600"
                                x-text="item.jenis_surat.nama_surat"
                            ></td>

                            <td
                                class="px-5 py-4 text-slate-600"
                                x-text="item.created_at ? new Date(item.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : ''"
                            ></td>

                            <td class="px-5 py-4 flex justify-center text-center">

                                <template x-if="item.status == 'menunggu_verifikasi'">
                                    <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                                        Menunggu Verifikasi
                                    </span>
                                </template>

                                <template x-if="item.status == 'diverifikasi_admin'">
                                    <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                        Diverifikasi Admin
                                    </span>
                                </template>

                                <template x-if="item.status == 'ditolak_admin'">
                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Ditolak Admin
                                    </span>
                                </template>

                            </td>

                            <td class="px-5 py-4">
                                <button
                                    type="button"
                                    @click="openDetail({
                                        id: item.id,
                                        nama: item.mahasiswa.nama,
                                        nim: item.mahasiswa.nim,
                                        prodi: item.mahasiswa.prodi,
                                        jenisSurat: item.jenis_surat.nama_surat,
                                        status: item.status,
                                        keperluan: item.keperluan,
                                        tanggal: item.created_at,
                                        file: '/storage/' + item.file_pengajuan,
                                        catatan: item.catatan_admin
                                    })"
                                    class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700"
                                >
                                    Detail
                                </button>
                            </td>

                        </tr>
                    </template>

                    <tr x-show="filteredItems.length === 0">
                        <td colspan="6" class="px-5 py-10 text-center text-slate-400">
                            Tidak ada data pengajuan yang sesuai.
                        </td>
                    </tr>

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
            @click.outside="detailOpen = false"
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
                    @click="detailOpen = false"
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
                            'border-amber-300 bg-amber-50 text-amber-700': selectedItem?.status === 'menunggu_verifikasi',
                            'border-blue-300 bg-blue-50 text-blue-700': selectedItem?.status === 'diverifikasi_admin',
                            'border-purple-300 bg-red-50 text-red-700': selectedItem?.status === 'ditolak_admin',
                        }"
                    >
                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                        <span x-text="
                            selectedItem?.status == 'menunggu_verifikasi'
                                ? 'Menunggu Verifikasi'
                                : selectedItem?.status == 'diverifikasi_admin'
                                ? 'Diverifikasi Admin'
                                : 'Ditolak Admin'
                        "></span>
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
                            <b class="text-right text-slate-700" x-text="selectedItem?.prodi"></b>
                        </div>
                    </div>
                </div>

                {{-- Informasi Surat --}}
                <div class="rounded-2xl bg-slate-50 p-4">
                    {{-- Catatan Admin --}}
                    <div
                        x-show="selectedItem?.status == 'ditolak_admin'"
                        class="rounded-2xl border border-red-200 bg-red-50 p-2 mb-2"
                    >
                        <h4 class="mb-3 flex items-center gap-2 font-semibold text-red-700">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M12 8V12M12 16H12.01M10.29 3.86L1.82 18A2 2 0 0 0 3.55 21H20.45A2 2 0 0 0 22.18 18L13.71 3.86A2 2 0 0 0 10.29 3.86Z"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                            Alasan Penolakan
                        </h4>

                        <p
                            class="pl-2 text-sm text-red-700 leading-relaxed"
                            x-text="selectedItem?.catatan || 'Tidak ada catatan.'"
                        ></p>
                    </div>

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
                            <b class="text-right text-slate-700" x-text="selectedItem?.jenisSurat"></b>
                        </div>

                        <div class="flex justify-between gap-4">
                            <span class="text-slate-500">Keperluan</span>
                            <div
                                class="max-w-sm text-right text-slate-700"
                                x-text="selectedItem?.keperluan"
                            ></div>
                        </div>

                        <div class="flex justify-between gap-4">
                            <span class="text-slate-500">Tanggal Pengajuan</span>
                            <b class="text-right text-slate-700" x-text="selectedItem?.tanggal ? new Date(selectedItem.tanggal).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : ''"></b>
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
                        File Pengajuan
                    </h4>

                    <div class="rounded-xl border border-slate-200 bg-white px-4 py-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="text-2xl">
                                    📄
                                </div>

                                <div>
                                    <p class="font-medium text-slate-700">
                                        Dokumen Pengajuan
                                    </p>

                                    <p class="text-xs text-slate-400">
                                        File yang diunggah mahasiswa
                                    </p>
                                </div>
                            </div>

                            <a
                                :href="selectedItem?.file"
                                target="_blank"
                                class="rounded-lg bg-blue-600 px-3 py-2 text-sm text-white hover:bg-blue-700"
                            >
                                Lihat File
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="space-y-4 border-t border-slate-100 pt-4">

                    {{-- Catatan Penolakan --}}
                    <div x-show="rejectOpen">
                        <form
                            :action="'/admin/pengajuan/' + selectedItem.id + '/tolak'"
                            method="POST"
                            class="space-y-3"
                        >
                            @csrf
                            @method('PUT')

                            <textarea
                                name="catatan_admin"
                                required
                                rows="3"
                                placeholder="Masukkan alasan penolakan..."
                                class="w-full rounded-xl border border-slate-200 p-3 text-sm focus:border-red-500 focus:ring-4 focus:ring-red-100"
                            ></textarea>

                            <div class="flex gap-3">
                                <button
                                    type="submit"
                                    class="rounded-xl bg-red-600 px-4 py-3 text-sm font-semibold text-white hover:bg-red-700"
                                >
                                    Konfirmasi Tolak
                                </button>

                                <button
                                    type="button"
                                    @click="rejectOpen = false"
                                    class="rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600"
                                >
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div
                        x-show="!rejectOpen &&
                                selectedItem?.status == 'menunggu_verifikasi'"
                        class="grid gap-3 sm:grid-cols-2"
                    >

                        {{-- Verifikasi --}}
                        <form
                            :action="'/admin/pengajuan/' + selectedItem.id + '/verifikasi'"
                            method="POST"
                        >
                            @csrf
                            @method('PUT')

                            <button
                                type="submit"
                                class="w-full rounded-xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white hover:bg-emerald-700"
                            >
                                ✓ Verifikasi
                            </button>
                        </form>

                        {{-- Tolak --}}
                        <button
                            type="button"
                            @click="rejectOpen = true"
                            class="w-full rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-600 hover:bg-red-100"
                        >
                            ✕ Tolak
                        </button>                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection