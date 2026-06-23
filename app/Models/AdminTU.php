<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminTU extends Model
{
    protected $table = 'admin_tu';

    protected $fillable = [
        'user_id',
        'nama',
        'nip',
        'jabatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
