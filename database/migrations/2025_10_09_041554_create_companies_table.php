<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            // Data dari langkah 1 (Data Diri)
            $table->string('nama_lengkap'); // Nama lengkap pendaftar
            $table->string('no_hp'); // Nomor HP
            $table->string('jabatan'); // Jabatan di perusahaan
            $table->string('email')->unique(); // Email (sekaligus untuk login)
            $table->string('password'); // Password

            // Data dari langkah 2 (Profil Perusahaan)
            $table->string('nama_perusahaan'); // Nama perusahaan
            $table->string('jumlah_karyawan')->nullable(); // Jumlah karyawan
            $table->string('industri')->nullable(); // Industri perusahaan
            $table->string('logo')->nullable(); // Path logo perusahaan

            // Data dari langkah 3 (Lokasi Perusahaan)
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('kecamatan')->nullable(); // Kolom baru
            $table->string('desa_kelurahan')->nullable(); // Kolom baru
            $table->text('alamat_lengkap')->nullable();

            // Status aktif/nonaktif
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
