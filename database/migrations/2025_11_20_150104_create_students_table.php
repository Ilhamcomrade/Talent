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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campus_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('nim')->unique()->nullable(); // Nomor Induk Mahasiswa
            $table->string('faculty')->nullable(); // Fakultas
            $table->string('study_program')->nullable(); // Program Studi
            $table->integer('year')->nullable(); // Tahun masuk
            $table->enum('semester', [1, 2, 3, 4, 5, 6, 7, 8])->nullable(); // Semester
            $table->enum('gender', ['L', 'P'])->nullable(); // Laki-laki, Perempuan
            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->text('address')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index(['campus_id', 'is_active']);
            $table->index('nim');
            $table->index('faculty');
            $table->index('study_program');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};