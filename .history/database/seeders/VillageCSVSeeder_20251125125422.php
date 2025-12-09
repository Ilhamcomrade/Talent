<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Village;

class VillageCSVSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Seeder ini membaca data dari file CSV desa.csv dan memasukkannya ke tabel villages
     */
    public function run(): void
    {
        $csvFile = database_path('data/desa.csv');

        // Cek apakah file CSV ada
        if (!file_exists($csvFile)) {
            $this->command->error("File CSV tidak ditemukan: {$csvFile}");
            return;
        }

        // Baca file CSV
        $file = fopen($csvFile, 'r');
        
        $villages = [];
        $count = 0;

        while (($row = fgetcsv($file)) !== false) {
            if (count($row) >= 3 && !empty($row[0])) {
                $villages[] = [
                    'id' => trim($row[0]),
                    'district_id' => trim($row[1]),
                    'name' => trim($row[2]),
                ];
                $count++;
                
                // Insert setiap 100 rows untuk performance
                if ($count % 100 == 0) {
                    foreach ($villages as $village) {
                        Village::updateOrCreate(
                            ['id' => $village['id']],
                            $village
                        );
                    }
                    $villages = [];
                    $this->command->info("Processed {$count} villages...");
                }
            }
        }

        fclose($file);

        // Insert remaining villages
        foreach ($villages as $village) {
            Village::updateOrCreate(
                ['id' => $village['id']],
                $village
            );
        }

        $this->command->info("Berhasil import {$count} data desa (villages)!");
    }
}
