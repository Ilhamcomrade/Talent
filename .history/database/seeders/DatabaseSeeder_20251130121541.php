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

        // Seed OLD system reference data
        $this->call([
            ProvinsiSeeder::class, // OLD system Provinsi
            KabupatenCSVSeeder::class, // OLD system Kabupaten dari CSV
            KecamatanCSVSeeder::class, // OLD system Kecamatan dari CSV
        ]);

        // Seed NEW system reference data
        $this->call([
            ProvinceSeeder::class, // NEW system Province
            KabupatenSeeder::class, // NEW system Regency (labeled as Kabupaten in seeder)
            DistrictCSVSeeder::class, // NEW system District
            VillageCSVSeeder::class, // NEW system Village
        ]);
    }
};