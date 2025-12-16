<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Kamu Sadewo',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('superadmin2025'),
                'role' => 'super admin',
                'is_active' => true,
                'google_id' => null,
                'avatar' => null,
                'lokasi' => null,
                'whatsapp' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'is_active' => true,
                'google_id' => null,
                'avatar' => null,
                'lokasi' => null,
                'whatsapp' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'dr raswah',
                'email' => 'leader@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'pimpinan',
                'is_active' => true,
                'google_id' => null,
                'avatar' => null,
                'lokasi' => null,
                'whatsapp' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}