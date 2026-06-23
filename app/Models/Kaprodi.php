<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kaprodi extends Model
{
    protected $table = 'kaprodi';

    protected $fillable = [
        'user_id',
        'nama',
        'nip',
        'prodi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
