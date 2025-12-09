<?php

namespace Database\Seeders;

use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class KabupatenCSVSeeder extends Seeder
{
    /**
     * Seeder untuk OLD system Kabupaten table dari CSV
     *
     * @return void
     */
    public function run(): void
    {
        $csvFile = database_path('data/kabupaten.csv');

        if (!file_exists($csvFile)) {
            $this->command->error("File tidak ditemukan: {$csvFile}");
            return;
        }

        $file = fopen($csvFile, 'r');
        $header = fgetcsv($file); // Skip header
        Log::info('CSV Header:', $header);

        $count = 0;
        $errorCount = 0;
        $rowNum = 0;

        while ($row = fgetcsv($file)) {
            $rowNum++;
            try {
                if (count($row) < 3) {
                    Log::warning("Row {$rowNum}: Insufficient columns");
                    continue;
                }

                $kodeKabupaten = trim($row[0]);
                $kodeProvinsi = trim($row[1]);
                $namaKabupaten = trim($row[2]);

                if (empty($kodeKabupaten) || empty($kodeProvinsi) || empty($namaKabupaten)) {
                    Log::warning("Row {$rowNum}: Empty values", ['row' => $row]);
                    continue;
                }

                Log::debug("Processing row {$rowNum}: kode_kabupaten={$kodeKabupaten}, kode_provinsi={$kodeProvinsi}, nama={$namaKabupaten}");

                // Find Provinsi by kode_provinsi
                $provinsi = Provinsi::where('kode_provinsi', $kodeProvinsi)->first();
                
                if (!$provinsi) {
                    Log::warning("Row {$rowNum}: Provinsi tidak ditemukan untuk kode: {$kodeProvinsi}");
                    $errorCount++;
                    continue;
                }

                // Check if kabupaten already exists
                $existing = Kabupaten::where('kode_kabupaten', $kodeKabupaten)
                    ->where('provinsi_id', $provinsi->id)
                    ->first();

                if (!$existing) {
                    Kabupaten::create([
                        'provinsi_id' => $provinsi->id,
                        'kode_kabupaten' => $kodeKabupaten,
                        'nama_kabupaten' => $namaKabupaten,
                        'jenis' => 'Kabupaten', // Default value
                        'status' => true
                    ]);
                    $count++;
                }
            } catch (\Exception $e) {
                $errorCount++;
                Log::error("Row {$rowNum}: Error importing kabupaten", [
                    'row' => $row,
                    'error' => $e->getMessage()
                ]);
            }
        }

        fclose($file);

        $this->command->info("Berhasil import {$count} data kabupaten (OLD system)!");
        if ($errorCount > 0) {
            $this->command->warn("Terdapat {$errorCount} error saat import");
        }
    }
}
