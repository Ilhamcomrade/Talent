<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            // Ubah visi dan misi dari string(255) menjadi text
            $table->text('visi')->nullable()->change();
            $table->text('misi')->nullable()->change();
            // alasan dan deskripsi_perusahaan sudah text, tidak perlu diubah
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            // Kembalikan ke string(255) jika rollback
            $table->string('visi', 255)->nullable()->change();
            $table->string('misi', 255)->nullable()->change();
        });
    }
};
