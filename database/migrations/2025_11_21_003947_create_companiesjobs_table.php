<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('companiesjobs', function (Blueprint $table) {
            $table->id();

            // Informasi Perusahaan
            $table->unsignedBigInteger('company_id')->nullable(); 
            $table->string('company_name'); 
            $table->string('industry')->nullable(); 
            $table->string('company_logo')->nullable();

            // Informasi Lowongan
            $table->string('title'); 
            $table->string('job_level')->nullable(); 

            // Gaji
            $table->boolean('show_salary')->default(false);
            $table->integer('salary_min')->nullable();
            $table->integer('salary_max')->nullable();

            // Tipe Kerja
            $table->string('employment_type')->nullable(); 
            $table->string('work_mode')->nullable(); 

            // Pendidikan & Pengalaman
            $table->string('education_level')->nullable(); 
            $table->string('experience')->nullable(); 

            // Skill list
            $table->json('skills')->nullable(); 

            // Persyaratan tambahan
            $table->text('requirements')->nullable();

            // Deskripsi pekerjaan
            $table->longText('description')->nullable();

            // ⭐ Tambahan Kolom Baru
            $table->longText('tanggung_jawab')->nullable();   // Responsibilities
            $table->longText('kualifikasi')->nullable();      // Qualifications
            $table->longText('nilai_tambah')->nullable();     // Nice to have

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('companiesjobs');
    }
};
