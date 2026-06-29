<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\UserSeeder;
use Database\Seeders\MahasiswaSeeder;
use Database\Seeders\AdminTUSeeder;
use Database\Seeders\KaprodiSeeder;
use Database\Seeders\JenisSuratSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            MahasiswaSeeder::class,
            AdminTUSeeder::class,
            KaprodiSeeder::class,
        ]);

        $this->call([
            JenisSuratSeeder::class,
        ]);
    }
}
