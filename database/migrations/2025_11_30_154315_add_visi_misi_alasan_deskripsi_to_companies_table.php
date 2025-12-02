<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('visi', 255)->nullable()->after('alamat_lengkap');
            $table->string('misi', 255)->nullable()->after('visi');
            $table->text('alasan')->nullable()->after('misi');
            $table->text('deskripsi_perusahaan')->nullable()->after('alasan');
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['visi', 'misi', 'alasan', 'deskripsi_perusahaan']);
        });
    }
};
