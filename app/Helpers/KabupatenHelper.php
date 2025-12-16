<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class KabupatenHelper
{
    /**
     * Import kabupaten dari array data
     * 
     * @param array $data Format: [['id' => '1101', 'province_id' => '11', 'name' => 'KABUPATEN SIMEULUE'], ...]
     * @return array ['success' => boolean, 'inserted' => int, 'updated' => int, 'failed' => int, 'errors' => array]
     */
    public static function importFromArray(array $data): array
    {
        $result = [
            'success' => true,
            'inserted' => 0,
            'updated' => 0,
            'failed' => 0,
            'errors' => []
        ];

        foreach ($data as $index => $item) {
            try {
                // Validasi data
                if (empty($item['id']) || empty($item['province_id']) || empty($item['name'])) {
                    throw new \Exception("Data tidak lengkap pada baris " . ($index + 1));
                }

                // Check apakah data sudah ada
                $existing = DB::table('regencies')->where('id', $item['id'])->first();

                if ($existing) {
                    // Update
                    DB::table('regencies')->where('id', $item['id'])->update([
                        'province_id' => $item['province_id'],
                        'name' => $item['name'],
                        'updated_at' => now()
                    ]);
                    $result['updated']++;
                } else {
                    // Insert
                    DB::table('regencies')->insert([
                        'id' => $item['id'],
                        'province_id' => $item['province_id'],
                        'name' => $item['name'],
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                    $result['inserted']++;
                }
            } catch (\Exception $e) {
                $result['failed']++;
                $result['errors'][] = "Baris " . ($index + 1) . ": " . $e->getMessage();
            }
        }

        return $result;
    }

    /**
     * Import kabupaten dari CSV file
     * 
     * @param string $filePath Path ke file CSV
     * @return array ['success' => boolean, 'inserted' => int, 'updated' => int, 'failed' => int, 'errors' => array]
     */
    public static function importFromCSV(string $filePath): array
    {
        if (!file_exists($filePath)) {
            return [
                'success' => false,
                'message' => "File tidak ditemukan: {$filePath}",
                'inserted' => 0,
                'updated' => 0,
                'failed' => 0,
                'errors' => []
            ];
        }

        $data = [];
        $file = fopen($filePath, 'r');
        fgetcsv($file); // Skip header

        while (($row = fgetcsv($file)) !== false) {
            if (count($row) >= 3 && !empty($row[0])) {
                $data[] = [
                    'id' => trim($row[0]),
                    'province_id' => trim($row[1]),
                    'name' => trim($row[2])
                ];
            }
        }

        fclose($file);

        return self::importFromArray($data);
    }

    /**
     * Mendapatkan semua kabupaten berdasarkan provinsi
     */
    public static function getByProvince(string $provinceId)
    {
        return DB::table('regencies')
            ->where('province_id', $provinceId)
            ->orderBy('name')
            ->get();
    }

    /**
     * Mendapatkan total kabupaten
     */
    public static function getTotal(): int
    {
        return DB::table('regencies')->count();
    }

    /**
     * Mendapatkan statistik kabupaten per provinsi
     */
    public static function getStats(): array
    {
        return DB::table('regencies')
            ->selectRaw('province_id, COUNT(*) as total')
            ->groupBy('province_id')
            ->get()
            ->toArray();
    }
}
