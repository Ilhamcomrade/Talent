<?php

namespace Database\Seeders;

use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DesaCSVSeeder extends Seeder
{
    /**
     * Seeder untuk OLD system Desa table dari CSV
     * 
     * CSV Structure: id, kecamatan_id, name
     * - id: kode_desa (e.g., 1101010001)
     * - kecamatan_id: kode_kecamatan (e.g., 1101010)
     * - name: nama_desa (e.g., "Latiung")
     *
     * @return void
     */
    public function run(): void
    {
        $csvFile = database_path('data/desa.csv');

        if (!file_exists($csvFile)) {
            $this->command->error("File tidak ditemukan: {$csvFile}");
            return;
        }

        $file = fopen($csvFile, 'r');
        $header = fgetcsv($file); // Skip header if exists

        $count = 0;
        $errorCount = 0;
        $rowNum = 0;

        while ($row = fgetcsv($file)) {
            $rowNum++;
            try {
                if (count($row) < 3) {
                    Log::warning("Desa CSV Row {$rowNum}: Insufficient columns");
                    continue;
                }

                $kodeDesa = trim($row[0]);          // e.g., "1101010001"
                $kodeKecamatan = trim($row[1]);     // e.g., "1101010"
                $namaDesa = trim($row[2]);          // e.g., "Latiung"

                if (empty($kodeDesa) || empty($kodeKecamatan) || empty($namaDesa)) {
                    Log::warning("Desa CSV Row {$rowNum}: Empty values", ['row' => $row]);
                    continue;
                }

                // Find Kecamatan by kode_kecamatan (OLD system)
                $kecamatan = Kecamatan::where('kode_kecamatan', $kodeKecamatan)->first();
                
                if (!$kecamatan) {
                    Log::warning("Desa CSV Row {$rowNum}: Kecamatan tidak ditemukan untuk kode_kecamatan={$kodeKecamatan}");
                    $errorCount++;
                    continue;
                }

                // Check if desa already exists
                $existing = Desa::where('kode_desa', $kodeDesa)
                    ->where('kecamatan_id', $kecamatan->id)
                    ->first();

                if (!$existing) {
                    Desa::create([
                        'kecamatan_id' => $kecamatan->id,
                        'kode_desa' => $kodeDesa,
                        'nama_desa' => $namaDesa,
                        'jenis' => 'Desa', // Default to Desa, can be Kelurahan
                        'status' => true
                    ]);
                    $count++;
                }
            } catch (\Exception $e) {
                Log::error("Desa CSV Row {$rowNum}: Error - " . $e->getMessage());
                $errorCount++;
            }
        }

        fclose($file);

        $this->command->info("Desa CSV Seeder berhasil: {$count} records ditambahkan, {$errorCount} errors");
    }
}
