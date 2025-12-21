<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('testimonis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('umur')->after('nama'); 
            $table->string('pekerjaan');
            $table->text('kesan_pesan');
            $table->string('foto')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('testimonis');
    }
};
