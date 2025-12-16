<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Regency;

class KabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Seeder ini membaca data dari file CSV dan memasukkannya ke tabel regencies
     */
    public function run(): void
    {
        $csvFile = database_path('data/kabupaten.csv');

        // Cek apakah file CSV ada
        if (!file_exists($csvFile)) {
            $this->command->error("File CSV tidak ditemukan: {$csvFile}");
            return;
        }

        // Baca file CSV
        $file = fopen($csvFile, 'r');
        $header = fgetcsv($file); // Skip header
        
        $regencies = [];
        $count = 0;

        while (($row = fgetcsv($file)) !== false) {
            if (count($row) >= 3 && !empty($row[0])) {
                $regencies[] = [
                    'id' => trim($row[0]),
                    'province_id' => trim($row[1]),
                    'name' => trim($row[2]),
                ];
                $count++;
            }
        }

        fclose($file);

        // Insert data ke database dengan updateOrCreate menggunakan Model
        foreach ($regencies as $regency) {
            Regency::updateOrCreate(
                ['id' => $regency['id']],
                $regency
            );
        }

        $this->command->info("Berhasil import {$count} data kabupaten!");
    }
}
