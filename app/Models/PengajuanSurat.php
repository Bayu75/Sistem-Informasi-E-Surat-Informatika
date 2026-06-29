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
        'status',
        'catatan_admin',
        'catatan_kaprodi',
        'tanggal_pengajuan',
        'file_pengajuan',
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
