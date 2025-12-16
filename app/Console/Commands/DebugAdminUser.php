<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DebugAdminUser extends Command
{
    protected $signature = 'debug:admin-users {--create-test : Create a test admin user}';
    protected $description = 'Debug admin users di database dan troubleshoot login issues';

    public function handle()
    {
        $this->info('🔍 ADMIN USER DEBUG SYSTEM\n');

        // Cek total users
        $totalUsers = User::count();
        $this->info("📊 Total users di database: {$totalUsers}");

        // Cek admin users
        $adminUsers = User::whereIn('role', ['super admin', 'admin', 'pimpinan', 'testdev'])->get();
        
        if ($adminUsers->isEmpty()) {
            $this->error("❌ MASALAH: Tidak ada user dengan role admin/super admin/pimpinan/testdev!");
            $this->warn("\n📌 Solusi: Jalankan seeder dengan command:");
            $this->warn("   php artisan db:seed --class=AdminUserSeeder");
            return;
        }

        $this->info("\n✅ Admin Users Found:\n");
        $this->table(
            ['ID', 'Name', 'Email', 'Role', 'Is Active', 'Created At'],
            $adminUsers->map(function($user) {
                return [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->role,
                    $user->is_active ? '✅ Yes' : '❌ No',
                    $user->created_at->format('Y-m-d H:i:s'),
                ];
            })->toArray()
        );

        // Cek regular users
        $regularUsers = User::where('role', 'user')->count();
        $this->info("\n👤 Total regular users (role='user'): {$regularUsers}");

        // Middleware check
        $this->info("\n🔐 Middleware Configuration:");
        $this->line("   ✅ AdminMiddleware allows: super admin, admin, pimpinan, testdev");
        $this->line("   ✅ SuperAdminMiddleware allows: super admin");
        $this->line("   ✅ WawancaraMiddleware allows: wawancara");

        // Login Flow Check
        $this->info("\n🔄 Login Flow Check:");
        $this->line("   1. User login dengan email & password");
        $this->line("   2. AuthController verifikasi credentials");
        $this->line("   3. Jika role = 'admin/super admin/pimpinan/testdev' → redirect to admin.dashboard");
        $this->line("   4. AdminMiddleware check role → allow access");
        $this->line("   5. DashboardController return view admin.dashboard");

        // Troubleshooting
        $this->info("\n⚠️  Troubleshooting Checklist:");
        
        if ($adminUsers->isEmpty()) {
            $this->error("   ❌ [CRITICAL] No admin users found - Run seeder first!");
        } else {
            $this->line("   ✅ Admin users exist in database");
        }

        $inactiveAdmins = $adminUsers->where('is_active', false)->count();
        if ($inactiveAdmins > 0) {
            $this->error("   ❌ Warning: {$inactiveAdmins} admin user(s) are inactive!");
        } else {
            $this->line("   ✅ All admin users are active");
        }

        $this->line("   📝 Remember:");
        $this->line("      - Email and password are case-sensitive");
        $this->line("      - Clear browser cache if you see redirect issues");
        $this->line("      - Check Laravel logs: storage/logs/laravel.log");

        // Option to create test user
        if ($this->option('create-test')) {
            $this->createTestUser();
        }

        $this->info("\n💡 Tips: Run 'php artisan debug:admin-users --create-test' to create a test admin");
    }

    private function createTestUser()
    {
        $this->info("\n🚀 Creating test admin user...");

        $testUser = User::firstOrCreate(
            ['email' => 'test.admin@gmail.com'],
            [
                'name' => 'Test Admin',
                'password' => Hash::make('test12345'),
                'role' => 'admin',
                'is_active' => true,
                'google_id' => null,
                'avatar' => null,
                'lokasi' => null,
                'whatsapp' => null,
            ]
        );

        $this->info("\n✅ Test Admin User Created/Updated:");
        $this->line("   Email: test.admin@gmail.com");
        $this->line("   Password: test12345");
        $this->line("   Role: admin");
        $this->line("\n📌 Use this to test login at: /masuk");
    }
}

