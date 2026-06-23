<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mahasiswa::create([
            'user_id' => 1,
            'nama' => 'Bayu',
            'nim' => '2308561012',
            'angkatan' => '2023',
            'prodi' => 'Informatika',
        ]);
    }
}
