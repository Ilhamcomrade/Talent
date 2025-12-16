<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample regencies - In production, use complete data from API or CSV
        $regencies = [
            // JAWA BARAT (31)
            ['id' => '3101', 'province_id' => '31', 'name' => 'BOGOR'],
            ['id' => '3102', 'province_id' => '31', 'name' => 'SUKABUMI'],
            ['id' => '3103', 'province_id' => '31', 'name' => 'CIANJUR'],
            ['id' => '3104', 'province_id' => '31', 'name' => 'BANDUNG'],
            ['id' => '3105', 'province_id' => '31', 'name' => 'GARUT'],
            
            // JAWA TENGAH (33)
            ['id' => '3301', 'province_id' => '33', 'name' => 'SEMARANG'],
            ['id' => '3302', 'province_id' => '33', 'name' => 'SURAKARTA'],
            ['id' => '3303', 'province_id' => '33', 'name' => 'YOGYAKARTA'],
            
            // JAWA TIMUR (35)
            ['id' => '3501', 'province_id' => '35', 'name' => 'SURABAYA'],
            ['id' => '3502', 'province_id' => '35', 'name' => 'MALANG'],
        ];

        DB::table('regencies')->insert($regencies);
    }
}
