<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisSurat;

class JenisSuratSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_surat' => 'Keterangan Aktif Kuliah Tunjangan Orang Tua/Tunjangan Anak/BPJS',
                'deskripsi' => 'Surat keterangan mahasiswa aktif untuk keperluan tunjangan dan BPJS.',
                'template_file' => 'DRAF KETERANGAN AKTIF TUNJANGAN ORANGTUA.docx',
            ],
            [
                'nama_surat' => 'Permohonan Surat Keterangan Mahasiswa Aktif Kuliah',
                'deskripsi' => 'Surat keterangan bahwa mahasiswa masih aktif kuliah.',
                'template_file' => 'DRAF KETERANGAN AKTIF MAHASISWA.docx',
            ],
            [
                'nama_surat' => 'Surat Keterangan Berkelakuan Baik',
                'deskripsi' => 'Surat keterangan berkelakuan baik dari program studi.',
                'template_file' => 'surat keterangan berkelakuan baik.docx',
            ],
            [
                'nama_surat' => 'Permohonan Surat Keterangan Tidak Menerima/Diusulkan Mendapat Beasiswa',
                'deskripsi' => 'Surat untuk keperluan pengajuan beasiswa.',
                'template_file' => 'surat keterangan tidak menerima beasisiwa lain.docx',
            ],
            [
                'nama_surat' => 'Surat Pengantar Permohonan Ijin Penelitian Proposal/TA',
                'deskripsi' => 'Surat pengantar penelitian tugas akhir atau proposal.',
                'template_file' => 'Permohonan Ijin penelitian.docx',
            ],
            [
                'nama_surat' => 'Permohonan Ijin Pengambilan Data',
                'deskripsi' => 'Surat izin untuk pengambilan data penelitian.',
                'template_file' => 'Permohonan Ijin Pengambilan Data.docx',
            ],
            [
                'nama_surat' => 'Permohonan Surat Tugas Sebagai Pakar',
                'deskripsi' => 'Surat tugas sebagai pakar atau ahli.',
                'template_file' => 'surat tugas Sebagai Pakar.docx',
            ],
        ];

        foreach ($data as $surat) {
            JenisSurat::create([
                'nama_surat'   => $surat['nama_surat'],
                'deskripsi'    => $surat['deskripsi'],
                'template_file'=> $surat['template_file'],
                'aktif'        => true,
            ]);
        }
    }
}