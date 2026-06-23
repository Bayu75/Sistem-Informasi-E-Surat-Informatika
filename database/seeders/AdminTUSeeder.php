<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdminTU;

class AdminTUSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminTU::create([
            'user_id' => 2,
            'nama' => 'Siti Rahma',
            'nip' => '19870001',
            'jabatan' => 'Admin Tata Usaha',
        ]);
    }
}
