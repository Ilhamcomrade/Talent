<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use App\Models\Kabupaten;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class KecamatanCSVSeeder extends Seeder
{
    /**
     * Seeder ini membaca data dari file CSV kecamatan.csv dan memasukkannya ke tabel kecamatans
     *
     * @return void
     */
    public function run(): void
    {
        $csvFile = database_path('data/kecamatan.csv');

        if (!file_exists($csvFile)) {
            $this->command->error("File tidak ditemukan: {$csvFile}");
            return;
        }

        $file = fopen($csvFile, 'r');
        $header = fgetcsv($file); // Skip header

        $count = 0;
        $errorCount = 0;

        while ($row = fgetcsv($file)) {
            try {
                if (count($row) < 3) {
                    continue;
                }

                $kodeKecamatan = trim($row[0]);
                $kabupatenId = trim($row[1]);
                $namaKecamatan = trim($row[2]);

                // Check if kabupaten exists
                $kabupaten = Kabupaten::where('id', $kabupatenId)->first();
                
                if (!$kabupaten) {
                    $errorCount++;
                    continue;
                }

                // Check if kecamatan already exists
                $existing = Kecamatan::where('kode_kecamatan', $kodeKecamatan)
                    ->where('kabupaten_id', $kabupaten->id)
                    ->first();

                if (!$existing) {
                    Kecamatan::create([
                        'kabupaten_id' => $kabupaten->id,
                        'kode_kecamatan' => $kodeKecamatan,
                        'nama_kecamatan' => $namaKecamatan,
                        'status' => true
                    ]);
                    $count++;
                }
            } catch (\Exception $e) {
                $errorCount++;
                Log::error("Error importing kecamatan: " . $e->getMessage());
            }
        }

        fclose($file);

        $this->command->info("Berhasil import {$count} data kecamatan!");
        if ($errorCount > 0) {
            $this->command->warn("Terdapat {$errorCount} error saat import");
        }
    }
}
