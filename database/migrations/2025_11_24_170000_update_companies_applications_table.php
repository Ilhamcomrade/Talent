<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('companies_applications', function (Blueprint $table) {

            // Profile
            $table->date('tgl_lahir')->nullable();
            $table->text('alamat')->nullable();

            // Wawancara
            $table->string('pendidikan')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->text('pengalaman_kerja')->nullable();
            $table->string('link_wawancara')->nullable();
            $table->date('tanggal_wawancara')->nullable();
            $table->text('desk_wawancara')->nullable();

            // Tes Dev
            $table->text('keahlian')->nullable();
            $table->string('foto')->nullable();
            $table->string('ijazah')->nullable();
            $table->text('desk_tes')->nullable();
            $table->string('link_tugas')->nullable();
        });

        // DROP constraint lama
        DB::statement("
            ALTER TABLE companies_applications
            DROP CONSTRAINT IF EXISTS companies_applications_status_check;
        ");

        // Tambah constraint baru
        DB::statement("
            ALTER TABLE companies_applications
            ADD CONSTRAINT companies_applications_status_check
            CHECK (status IN (
                'masuk',
                'diproses',
                'profile_lolos',
                'wawancara_lolos',
                'tes_lolos',
                'diterima',
                'ditolak'
            ));
        ");
    }

    public function down(): void
    {
        // Rollback status constraint ke awal
        DB::statement("
            ALTER TABLE companies_applications
            DROP CONSTRAINT IF EXISTS companies_applications_status_check;
        ");

        DB::statement("
            ALTER TABLE companies_applications
            ADD CONSTRAINT companies_applications_status_check
            CHECK (status IN (
                'masuk',
                'diproses',
                'diterima',
                'ditolak'
            ));
        ");

        // Hapus kolom yang ditambahkan
        Schema::table('companies_applications', function (Blueprint $table) {
            $table->dropColumn([
                'tgl_lahir',
                'alamat',

                'pendidikan',
                'asal_sekolah',
                'pengalaman_kerja',
                'link_wawancara',
                'tanggal_wawancara',
                'desk_wawancara',

                'keahlian',
                'foto',
                'ijazah',
                'desk_tes',
                'link_tugas'
            ]);
        });
    }
};
