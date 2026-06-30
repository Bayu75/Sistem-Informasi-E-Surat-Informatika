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
            'nama' => 'Kadek Bayu Dwi Pradnya',
            'nim' => '2408561059',
            'angkatan' => '2024',
            'prodi' => 'Informatika',
        ]);

        Mahasiswa::create([
            'user_id' => 2,
            'nama' => 'I Made Aditya Pratama',
            'nim' => '2408561060',
            'angkatan' => '2024',
            'prodi' => 'Informatika',
        ]);

        Mahasiswa::create([
            'user_id' => 3,
            'nama' => 'Ni Luh Putu Ayu Maytta Wulandhani',
            'nim' => '2408561061',
            'angkatan' => '2024',
            'prodi' => 'Informatika',
        ]);
    }
}
