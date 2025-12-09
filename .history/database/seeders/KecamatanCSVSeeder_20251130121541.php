<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use App\Models\Kabupaten;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class KecamatanCSVSeeder extends Seeder
{
    /**
     * Seeder untuk OLD system Kecamatan table dari CSV
     * 
     * CSV Structure: id, province_id, name
     * - id: kode_kecamatan (e.g., 1101010)
     * - province_id: kode_provinsi (e.g., 11)
     * - name: nama_kecamatan (e.g., "Arongan Lambalek")
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
        $rowNum = 0;

        while ($row = fgetcsv($file)) {
            $rowNum++;
            try {
                if (count($row) < 3) {
                    Log::warning("Kecamatan CSV Row {$rowNum}: Insufficient columns");
                    continue;
                }

                $kodeKecamatan = trim($row[0]);    // e.g., "1101010"
                $kodeProvinsi = trim($row[1]);     // e.g., "11" (to extract kode_kabupaten)
                $namaKecamatan = trim($row[2]);    // e.g., "Arongan Lambalek"

                if (empty($kodeKecamatan) || empty($kodeProvinsi) || empty($namaKecamatan)) {
                    Log::warning("Kecamatan CSV Row {$rowNum}: Empty values", ['row' => $row]);
                    continue;
                }

                // Extract kode_kabupaten from kode_kecamatan (first 4 digits)
                // e.g., "1101010" -> "1101"
                $kodeKabupaten = substr($kodeKecamatan, 0, 4);

                // Find Kabupaten by kode_kabupaten (OLD system)
                $kabupaten = Kabupaten::where('kode_kabupaten', $kodeKabupaten)->first();
                
                if (!$kabupaten) {
                    Log::warning("Kecamatan CSV Row {$rowNum}: Kabupaten tidak ditemukan untuk kode_kabupaten={$kodeKabupaten}");
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
                Log::error("Kecamatan CSV Row {$rowNum}: Error importing", [
                    'kode_kecamatan' => $row[0] ?? null,
                    'error' => $e->getMessage()
                ]);
            }
        }

        fclose($file);

        $this->command->info("Berhasil import {$count} data kecamatan (OLD system)!");
        if ($errorCount > 0) {
            $this->command->warn("Terdapat {$errorCount} error saat import");
        }
    }
}

