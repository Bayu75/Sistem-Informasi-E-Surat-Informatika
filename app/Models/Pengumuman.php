<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = [

        'judul',
        'kategori',
        'ringkasan',
        'isi',
        'file',
        'nama_file_asli',
        'tanggal',
        'status',
        'created_by',
    ];

    public function creator()
        {
            return $this->belongsTo(User::class, 'created_by');
        }

}
