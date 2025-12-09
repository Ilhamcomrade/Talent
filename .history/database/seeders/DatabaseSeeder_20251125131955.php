<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed admin users first (original data yang tidak boleh dihapus)
        $this->call([
            AdminUserSeeder::class,
        ]);

        // Seed reference data
        $this->call([
            ProvinceSeeder::class,
            KabupatenSeeder::class,
            DistrictCSVSeeder::class, // Seeder untuk membaca kecamatan dari CSV
            VillageCSVSeeder::class, // Seeder untuk membaca desa dari CSV
        ]);
    }
};