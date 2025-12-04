<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companiesmagang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');

            $table->string('title');
            $table->string('department')->nullable();
            $table->string('lokasi');

            $table->text('deskripsi');
            $table->text('kualifikasi')->nullable();
            $table->text('tanggung_jawab')->nullable();

            $table->string('benefit')->nullable();

            $table->enum('type', ['fulltime', 'parttime', 'remote', 'internship'])->default('internship');

            $table->string('durasi')->nullable();
            $table->integer('kuota')->default(1);

            $table->integer('gaji_min')->nullable();
            $table->integer('gaji_max')->nullable();

            $table->date('deadline')->nullable();

            $table->enum('status', ['aktif', 'nonaktif', 'expired'])->default('aktif');

            $table->timestamps();

            $table->foreign('company_id')
                ->references('id')->on('companies')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companiesmagang');
    }
};
