<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'mahasiswa@unud.ac.id',
            'password' => bcrypt('mahasiswa123'),
            'role' => 'mahasiswa',
        ]);

        User::create([
            'email' => 'admin@unud.ac.id',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'email' => 'kaprodi@unud.ac.id',
            'password' => bcrypt('kaprodi123'),
            'role' => 'kaprodi',
        ]);
    }
}
