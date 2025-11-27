<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies_applications', function (Blueprint $table) {
            $table->id();

            // Relasi ke perusahaan
            $table->unsignedBigInteger('company_id');

            // Relasi ke lowongan pekerjaan
            $table->unsignedBigInteger('companies_job_id');

            // Data pelamar
            $table->string('nama');
            $table->string('email');
            $table->string('telepon')->nullable();
            $table->string('cv')->nullable();              // path file CV
            $table->string('surat_lamaran')->nullable();   // optional
            $table->text('catatan')->nullable();           // catatan dari pelamar

            // Status lamaran
            $table->enum('status', ['masuk', 'diproses', 'diterima', 'ditolak'])
                  ->default('masuk');

            $table->timestamps();

            // Foreign Key (tidak wajib tetapi disarankan)
            $table->foreign('company_id')
                  ->references('id')->on('companies')
                  ->onDelete('cascade');

            $table->foreign('companies_job_id')
                  ->references('id')->on('companiesjobs')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies_applications');
    }
};
