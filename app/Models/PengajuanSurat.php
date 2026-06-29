<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    protected $table = 'pengajuan_surat';

    protected $fillable = [
        'mahasiswa_id',
        'jenis_surat_id',
        'keperluan',

        'file_pengajuan',
        'file_surat',

        'status',

        'catatan_admin',
        'catatan_kaprodi',

        'tanggal_pengajuan',
        'tanggal_verifikasi_admin',
        'tanggal_keputusan_kaprodi',
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'datetime',
        'tanggal_verifikasi_admin' => 'datetime',
        'tanggal_keputusan_kaprodi' => 'datetime',
    ];

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
