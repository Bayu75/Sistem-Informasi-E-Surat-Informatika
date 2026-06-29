<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = [
        'user_id',
        'nama',
        'nim',
        'angkatan',
        'prodi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengajuanSurat()
    {
        return $this->hasMany(PengajuanSurat::class);
    }
}
