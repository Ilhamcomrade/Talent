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
        Schema::create('kabupatens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provinsi_id')->constrained('provinsis')->onDelete('cascade');
            $table->string('kode_kabupaten', 10);
            $table->string('nama_kabupaten', 100);
            $table->enum('jenis', ['Kabupaten', 'Kota']);
            $table->text('deskripsi')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            
            // Indexes
            $table->index('kode_kabupaten');
            $table->index('nama_kabupaten');
            $table->index('jenis');
            $table->index('status');
            $table->index(['provinsi_id', 'status']);
            
            // Unique constraint
            $table->unique(['kode_kabupaten', 'provinsi_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kabupatens');
    }
};