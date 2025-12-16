<?php

namespace App\Console\Commands;

use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Console\Command;

class SeedDesaFromCsv extends Command
{
    protected $signature = 'seed:desa';
    protected $description = 'Seed desa data from CSV file';

    public function handle()
    {
        $csvFile = database_path('data/desa.csv');

        if (!file_exists($csvFile)) {
            $this->error("File tidak ditemukan: {$csvFile}");
            return;
        }

        $file = fopen($csvFile, 'r');
        if (!$file) {
            $this->error("Gagal membuka file: {$csvFile}");
            return;
        }

        $header = fgetcsv($file);
        $count = 0;
        $errorCount = 0;
        $rowNum = 0;
        $limit = 5000;

        $bar = $this->output->createProgressBar(5000);

        while (($row = fgetcsv($file)) !== false && $rowNum < $limit) {
            $rowNum++;
            $bar->advance();

            try {
                if (count($row) < 3) continue;

                $kodeDesa = trim($row[0]);
                $kodeKecamatan = trim($row[1]);
                $namaDesa = trim($row[2]);

                if (empty($kodeDesa) || empty($kodeKecamatan) || empty($namaDesa)) {
                    continue;
                }

                $kecamatan = Kecamatan::where('kode_kecamatan', $kodeKecamatan)->first();
                
                if (!$kecamatan) {
                    $errorCount++;
                    continue;
                }

                $existing = Desa::where('kode_desa', $kodeDesa)
                    ->where('kecamatan_id', $kecamatan->id)
                    ->first();

                if (!$existing) {
                    Desa::create([
                        'kecamatan_id' => $kecamatan->id,
                        'kode_desa' => $kodeDesa,
                        'nama_desa' => $namaDesa,
                        'jenis' => 'Desa',
                        'status' => true
                    ]);
                    $count++;
                }
            } catch (\Exception $e) {
                $errorCount++;
            }
        }

        fclose($file);
        $bar->finish();

        $this->newLine();
        $this->info("Desa CSV Seeder berhasil: {$count} records ditambahkan, {$errorCount} errors");
    }
}
