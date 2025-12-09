<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\District;

class DistrictCSVSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Seeder ini membaca data dari file CSV kecamatan.csv dan memasukkannya ke tabel districts
     */
    public function run(): void
    {
        $csvFile = database_path('data/kecamatan.csv');

        // Cek apakah file CSV ada
        if (!file_exists($csvFile)) {
            $this->command->error("File CSV tidak ditemukan: {$csvFile}");
            return;
        }

        // Baca file CSV
        $file = fopen($csvFile, 'r');
        $header = fgetcsv($file); // Skip header
        
        $districts = [];
        $count = 0;

        while (($row = fgetcsv($file)) !== false) {
            if (count($row) >= 3 && !empty($row[0])) {
                $districts[] = [
                    'id' => trim($row[0]),
                    'regency_id' => trim($row[1]),
                    'name' => trim($row[2]),
                ];
                $count++;
            }
        }

        fclose($file);

        // Insert data ke database dengan updateOrCreate menggunakan Model
        foreach ($districts as $district) {
            District::updateOrCreate(
                ['id' => $district['id']],
                $district
            );
        }

        $this->command->info("Berhasil import {$count} data kecamatan (districts)!");
    }
}
