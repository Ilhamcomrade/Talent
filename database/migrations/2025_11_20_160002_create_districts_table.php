<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('regency_id', 10);
            $table->string('name', 100);
            $table->timestamps();
            
            $table->foreign('regency_id')->references('id')->on('regencies')->onDelete('cascade');
            $table->index('regency_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('districts');
    }
};
