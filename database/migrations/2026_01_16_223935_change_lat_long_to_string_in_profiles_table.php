<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            // Ubah dari decimal ke string
            $table->string('latitude', 50)->nullable()->change();
            $table->string('longitude', 50)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            // Kembalikan ke decimal jika perlu rollback
            $table->decimal('latitude', 30, 8)->nullable()->change();
            $table->decimal('longitude', 30, 8)->nullable()->change();
        });
    }
};
