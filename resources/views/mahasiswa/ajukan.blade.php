@extends('layouts.mahasiswa')

@section('title', 'Ajukan Surat - Portal Mahasiswa')
@section('page-title', 'Ajukan Surat')

@php
    $activeMenu = 'ajukan';
@endphp

@section('content')
<div
    class="mx-auto max-w-3xl"
    x-data="{
        jenisSurat: '',

        templates: {
            surat_keterangan_aktif_kuliah: {
                nama: 'Template_SKA_Kuliah.pdf',
                deskripsi: 'Template standar surat keterangan aktif kuliah resmi kampus.',
                ukuran: '245 KB',
                dokumen: [
                    'KTM (Kartu Tanda Mahasiswa)',
                    'KRS Semester Terbaru',
                    'Bukti Pembayaran UKT'
                ]
            },
            surat_keterangan_mahasiswa: {
                nama: 'Template_Surat_Keterangan_Mahasiswa.pdf',
                deskripsi: 'Template surat keterangan mahasiswa aktif sebagai bukti status kemahasiswaan.',
                ukuran: '230 KB',
                dokumen: [
                    'KTM (Kartu Tanda Mahasiswa)',
                    'KRS Semester Terbaru',
                    'Bukti Pembayaran UKT'
                ]
            },
            surat_pengantar_pkl_magang: {
                nama: 'Template_Surat_Pengantar_PKL_Magang.pdf',
                deskripsi: 'Template surat pengantar resmi untuk kebutuhan PKL atau magang.',
                ukuran: '260 KB',
                dokumen: [
                    'KTM (Kartu Tanda Mahasiswa)',
                    'Proposal PKL/Magang',
                    'Surat Penerimaan dari Perusahaan/Instansi'
                ]
            },
            surat_permohonan_beasiswa: {
                nama: 'Template_Surat_Permohonan_Beasiswa.pdf',
                deskripsi: 'Template surat permohonan beasiswa untuk keperluan administrasi akademik.',
                ukuran: '275 KB',
                dokumen: [
                    'KTM (Kartu Tanda Mahasiswa)',
                    'KRS Semester Terbaru',
                    'Transkrip Nilai',
                    'Bukti Pembayaran UKT',
                    'Sertifikat Prestasi jika ada'
                ]
            },
            surat_keterangan_lulus: {
                nama: 'Template_Surat_Keterangan_Lulus.pdf',
                deskripsi: 'Template surat keterangan lulus untuk mahasiswa yang telah menyelesaikan studi.',
                ukuran: '240 KB',
                dokumen: [
                    'KTM (Kartu Tanda Mahasiswa)',
                    'Transkrip Nilai Terakhir',
                    'Bukti Bebas Administrasi',
                    'Bukti Bebas Perpustakaan'
                ]
            },
            surat_rekomendasi: {
                nama: 'Template_Surat_Rekomendasi.pdf',
                deskripsi: 'Template surat rekomendasi untuk kebutuhan akademik atau non-akademik.',
                ukuran: '255 KB',
                dokumen: [
                    'KTM (Kartu Tanda Mahasiswa)',
                    'KRS Semester Terbaru',
                    'Transkrip Nilai',
                    'Dokumen Pendukung Tujuan Rekomendasi'
                ]
            },
            surat_cuti_kuliah: {
                nama: 'Template_Surat_Cuti_Kuliah.pdf',
                deskripsi: 'Template surat permohonan cuti kuliah resmi kepada pihak akademik.',
                ukuran: '250 KB',
                dokumen: [
                    'KTM (Kartu Tanda Mahasiswa)',
                    'Surat Permohonan Cuti',
                    'Bukti Alasan Cuti',
                    'Persetujuan Orang Tua/Wali jika diperlukan'
                ]
            },
            surat_dispensasi: {
                nama: 'Template_Surat_Dispensasi.pdf',
                deskripsi: 'Template surat dispensasi untuk kegiatan akademik maupun non-akademik.',
                ukuran: '235 KB',
                dokumen: [
                    'KTM (Kartu Tanda Mahasiswa)',
                    'Undangan/Surat Resmi Kegiatan',
                    'Jadwal Kegiatan'
                ]
            }
        },

        get selectedTemplate() {
            return this.templates[this.jenisSurat] ?? null;
        },

        hasTemplate() {
            return this.selectedTemplate !== null;
        }
    }"
>
    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="bg-gradient-to-r from-cyan-600 to-blue-700 px-6 py-5 text-white">
            <h3 class="text-xl font-semibold">Formulir Pengajuan Surat</h3>
            <p class="mt-1 text-sm text-cyan-100">Isi formulir berikut dengan lengkap dan benar</p>
        </div>

        <form class="space-y-6 p-6">
            <div class="rounded-2xl bg-slate-50 p-5">
                <h4 class="mb-4 font-semibold text-slate-700">Data Mahasiswa (Otomatis)</h4>

                <div class="grid gap-4 text-sm sm:grid-cols-2">
                    <div>
                        <p class="text-slate-400">Nama Lengkap</p>
                        <p class="font-semibold text-slate-700">{{ auth()->user()->mahasiswa->nama }}</p>
                    </div>

                    <div>
                        <p class="text-slate-400">NIM</p>
                        <p class="font-semibold text-slate-700">{{ auth()->user()->mahasiswa->nim }}</p>
                    </div>

                    <div>
                        <p class="text-slate-400">Program Studi</p>
                        <p class="font-semibold text-slate-700">{{ auth()->user()->mahasiswa->prodi }}</p>
                    </div>

                    <div>
                        <p class="text-slate-400">Email</p>
                        <p class="font-semibold text-slate-700">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Jenis Surat <span class="text-red-500">*</span>
                </label>

                <select
                    x-model="jenisSurat"
                    class="h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm outline-none focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100"
                >
                    <option value="">Pilih jenis surat...</option>
                    <option value="surat_keterangan_aktif_kuliah">Surat Keterangan Aktif Kuliah</option>
                    <option value="surat_keterangan_mahasiswa">Surat Keterangan Mahasiswa</option>
                    <option value="surat_pengantar_pkl_magang">Surat Pengantar PKL/Magang</option>
                    <option value="surat_permohonan_beasiswa">Surat Permohonan Beasiswa</option>
                    <option value="surat_keterangan_lulus">Surat Keterangan Lulus</option>
                    <option value="surat_rekomendasi">Surat Rekomendasi</option>
                    <option value="surat_cuti_kuliah">Surat Cuti Kuliah</option>
                    <option value="surat_dispensasi">Surat Dispensasi</option>
                </select>
            </div>

            <div
                x-show="hasTemplate()"
                x-transition
                class="rounded-2xl border border-cyan-200 bg-cyan-50 p-5"
                style="display: none;"
            >
                <h4 class="mb-4 flex items-center gap-2 font-semibold text-cyan-700">
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
                    Template Surat Tersedia
                </h4>

                <div class="rounded-2xl border border-slate-200 bg-white p-4">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-sm font-bold text-red-500">
                            PDF
                        </div>

                        <div class="min-w-0">
                            <p class="truncate font-semibold text-slate-700" x-text="selectedTemplate?.nama"></p>
                            <p class="text-sm text-slate-400" x-text="selectedTemplate?.deskripsi"></p>
                            <p class="mt-1 text-xs text-slate-400">
                                Ukuran:
                                <span x-text="selectedTemplate?.ukuran"></span>
                            </p>
                        </div>
                    </div>

                    <div class="mt-4 grid gap-3 sm:grid-cols-2">
                        <a
                            href="#"
                            class="rounded-xl border border-cyan-200 bg-white px-4 py-3 text-center text-sm font-semibold text-cyan-600"
                        >
                            Lihat Template
                        </a>

                        <a
                            href="#"
                            class="rounded-xl bg-cyan-600 px-4 py-3 text-center text-sm font-semibold text-white"
                        >
                            Download Template
                        </a>
                    </div>
                </div>

                <p class="mt-4 text-sm font-medium text-cyan-600">
                    ⓘ Unduh template, isi, lalu upload sebagai dokumen pendukung di bawah.
                </p>
            </div>

            <div
                x-show="hasTemplate()"
                x-transition
                class="rounded-2xl border border-cyan-200 bg-cyan-50 p-5"
                style="display: none;"
            >
                <h4 class="mb-4 flex items-center gap-2 font-semibold text-slate-700">
                    <svg class="h-5 w-5 text-cyan-600" viewBox="0 0 24 24" fill="none">
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
                    Dokumen Pendukung yang Dibutuhkan
                </h4>

                <div class="space-y-2 text-sm font-medium text-slate-600">
                    <template x-for="(dokumen, index) in selectedTemplate?.dokumen" :key="dokumen">
                        <p class="flex items-center gap-2">
                            <span
                                class="inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-cyan-200 text-xs font-bold text-cyan-700"
                                x-text="index + 1"
                            ></span>

                            <span x-text="dokumen"></span>
                        </p>
                    </template>
                </div>

                <div class="mt-4 border-t border-cyan-200 pt-3 text-sm font-medium text-cyan-600">
                    ⓘ Upload semua dokumen di atas pada bagian "Dokumen Pendukung" di bawah.
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Keperluan / Tujuan Surat <span class="text-red-500">*</span>
                </label>

                <textarea
                    rows="5"
                    placeholder="Jelaskan keperluan pengajuan surat ini secara rinci..."
                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100"
                ></textarea>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    File Surat Pengajuan <span class="text-red-500">*</span>
                </label>

                <label class="flex min-h-28 cursor-pointer flex-col items-center justify-center rounded-xl border border-dashed border-slate-300 bg-white text-center transition hover:border-cyan-300 hover:bg-cyan-50">
                    <span class="mb-2 text-2xl text-slate-400">⇧</span>
                    <span class="text-sm font-semibold text-slate-500">Klik untuk upload file surat pengajuan</span>
                    <span class="text-xs text-slate-400">Format: PDF, DOC, DOCX</span>
                    <input type="file" class="hidden">
                </label>

                <p class="mt-2 text-xs text-slate-400">
                    Surat permohonan utama yang telah ditandatangani. Format: PDF, DOC, DOCX.
                </p>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Dokumen Pendukung <span class="text-red-500">*</span>
                </label>

                <div class="rounded-xl border border-dashed border-slate-300 p-4">
                    <div class="grid gap-3 sm:grid-cols-[1fr_auto]">
                        <input
                            type="text"
                            placeholder="Nama file (contoh: KTM, Transkrip_Nilai)"
                            class="h-11 rounded-xl border border-slate-200 px-4 text-sm outline-none focus:border-cyan-500"
                        >

                        <button type="button" class="rounded-xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white">
                            ⇧ Tambah
                        </button>
                    </div>

                    <div class="mt-5 text-center text-sm text-slate-400">
                        ⇧<br>
                        Tambahkan dokumen pendukung di atas
                    </div>
                </div>

                <p class="mt-2 text-xs text-slate-400">
                    * KTM wajib disertakan. Format: PDF, JPG, PNG.
                </p>
            </div>

            <div class="rounded-2xl border border-cyan-200 bg-cyan-50 p-4 text-sm text-cyan-700">
                <p class="font-semibold">ⓘ Proses Pengajuan</p>
                <p class="mt-1">
                    Pengajuan akan diverifikasi Admin TU dalam 1-2 hari kerja, lalu diteruskan ke Kaprodi untuk persetujuan akhir.
                </p>
            </div>

            <div class="grid gap-3 border-t border-slate-100 pt-4 sm:grid-cols-2">
                <button type="reset" class="rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600">
                    Reset Form
                </button>

                <button type="button" class="rounded-xl bg-cyan-600 px-4 py-3 text-sm font-semibold text-white">
                    ✈ Kirim Pengajuan
                </button>
            </div>
        </form>
    </section>
</div>
@endsection