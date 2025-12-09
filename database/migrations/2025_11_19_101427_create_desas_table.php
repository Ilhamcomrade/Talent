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
        Schema::create('desas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kecamatan_id')->constrained('kecamatans')->onDelete('cascade');
            $table->string('kode_desa', 10);
            $table->string('nama_desa', 100);
            $table->enum('jenis', ['Desa', 'Kelurahan']);
            $table->string('kodepos', 10)->nullable();
            $table->text('deskripsi')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            
            // Indexes
            $table->index('kode_desa');
            $table->index('nama_desa');
            $table->index('jenis');
            $table->index('kodepos');
            $table->index('status');
            $table->index(['kecamatan_id', 'status']);
            
            // Unique constraint
            $table->unique(['kode_desa', 'kecamatan_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desas');
    }
};