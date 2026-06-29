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
        filePengajuan: null,

        templates: {
            @foreach($jenisSurat as $surat)
            '{{ $surat->id }}': {
                nama: @js($surat->template_file),
                deskripsi: @js($surat->deskripsi),
                url: @js(asset('storage/templates/' . $surat->template_file))
            },
            @endforeach
        },

        selectedTemplate: null,
    }"

    x-init="
        $watch('jenisSurat', value => {
            selectedTemplate = templates[value] ?? null
        })
    "
>
    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="bg-gradient-to-r from-cyan-600 to-blue-700 px-6 py-5 text-white">
            <h3 class="text-xl font-semibold">Formulir Pengajuan Surat</h3>
            <p class="mt-1 text-sm text-cyan-100">Isi formulir berikut dengan lengkap dan benar</p>
        </div>


        @if(session('success'))
            <div class="mb-4 rounded-xl bg-green-50 p-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif
        <form
            action="{{ route('pengajuan.store') }}"
            method="POST"
            enctype="multipart/form-data" 
            class="space-y-6 p-6">
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
                    name="jenis_surat_id"
                    x-model="jenisSurat"
                    class="h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 outline-none transition focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100"
                >
                    <option value="">Pilih jenis surat...</option>

                    @foreach($jenisSurat as $surat)
                        <option value="{{ $surat->id }}">
                            {{ $surat->nama_surat }}
                        </option>
                    @endforeach
                </select>
                

                @error('jenis_surat_id')
                    <p class="mt-1 text-sm text-red-500">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div
                x-show="templates[jenisSurat]"
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
                        </div>
                    </div>

                    <div class="mt-4">
                        <a
                            :href="selectedTemplate?.url"
                            download
                            class="flex items-center justify-center gap-2 rounded-xl bg-cyan-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700"
                        >
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                <path d="M12 3V15M12 15L7 10M12 15L17 10M5 21H19"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"/>
                            </svg>
                            Download Template Surat
                        </a>
                    </div>
                </div>

                <p class="mt-4 text-sm font-medium text-cyan-600">
                    ⓘ Unduh template, isi, lalu upload sebagai dokumen pendukung di bawah.
                </p>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Keperluan / Tujuan Surat <span class="text-red-500">*</span>
                </label>

                <textarea
                    name="keperluan"
                    rows="5"
                    placeholder="Contoh: Digunakan sebagai persyaratan pengajuan beasiswa KIP Kuliah."
                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100 resize-none"
                >{{ old('keperluan') }}</textarea>

                @error('keperluan')
                    <p class="text-red-500 text-sm">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    File Surat Pengajuan
                    <span class="text-red-500">*</span>
                </label>

                <label class="flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 px-6 py-8 text-center transition hover:border-cyan-400 hover:bg-cyan-50">
                    <div class="mb-3 text-4xl text-cyan-500">
                        📄
                    </div>

                    <p class="font-semibold text-slate-700">
                        Klik untuk memilih file
                    </p>

                    <p class="mt-1 text-sm text-slate-500">
                        PDF, DOC, DOCX
                    </p>

                    <input
                        x-ref="filePengajuanInput"
                        type="file"
                        name="file_pengajuan"
                        accept=".pdf,.doc,.docx"
                        class="hidden"
                        @change="filePengajuan = $event.target.files[0]"
                    >
                </label>

                <div
                    x-show="filePengajuan"
                    class="mt-3 rounded-xl bg-green-50 p-3 text-sm text-green-700"
                >
                    📄
                    <span x-text="filePengajuan?.name"></span>
                </div>

                @error('file_pengajuan')
                    <p class="mt-2 text-sm text-red-500">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="rounded-2xl border border-cyan-200 bg-cyan-50 p-4 text-sm text-cyan-700">
                <p class="font-semibold">ⓘ Proses Pengajuan</p>
                <p class="mt-1">
                    Pengajuan akan diverifikasi Admin TU dalam 1-2 hari kerja, lalu diteruskan ke Kaprodi untuk persetujuan akhir.
                </p>
            </div>

            <div class="grid gap-3 border-t border-slate-100 pt-4 sm:grid-cols-2">
                <button
                    type="button"
                    class="cursor-pointer rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600"
                    @click="
                        jenisSurat = '';
                        filePengajuan = null;
                        $refs.filePengajuanInput.value = '';
                        $el.closest('form').reset();
                    "
                >
                    Reset Form
                </button>

                <button type="submit" class="cursor-pointer rounded-xl bg-cyan-600 px-4 py-3 text-sm font-semibold text-white">
                    ✈ Kirim Pengajuan
                </button>
            </div>
        </form>
    </section>
</div>
@endsection