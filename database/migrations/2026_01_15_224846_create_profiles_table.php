<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            // Informasi Kontak
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('operation_hours')->nullable();

            // Lokasi Perusahaan - UBAH JADI STRING untuk presisi tak terbatas
            $table->string('latitude', 50)->nullable(); // Changed from decimal(30,8)
            $table->string('longitude', 50)->nullable(); // Changed from decimal(30,8)
            $table->string('map_popup_text')->nullable();

            // Logo
            $table->string('logo_navbar_public')->nullable();
            $table->string('logo_navbar_company')->nullable();
            $table->string('logo_navbar_campus')->nullable();
            $table->string('logo_footer')->nullable();

            $table->timestamps();
        });

        // Insert data default
        $this->seedDefaultData();
    }

    private function seedDefaultData()
    {
        \App\Models\Profile::create([
            'address' => 'Jl. Pratista Utara III No.2, Antapani Kidul, Kec. Antapani, Kota Bandung, Jawa Barat, Indonesia 4029',
            'email' => 'corporate@inotal.tech',
            'phone' => '+(62) 82115179879',
            'operation_hours' => 'Senin - Jumat, 08.00 - 16.00 WIB',
            'latitude' =>  '-6.925457980196308',
            'longitude' =>   '107.66299344598612',
            'map_popup_text' => 'PT INOTAL SISTEMA INTERNASIONAL Jl. Pratista Utara III No.2, Antapani.',
            'logo_navbar_public' => 'images/logo_inotal.png',
            'logo_navbar_company' => 'images/logo_inotal.png',
            'logo_navbar_campus' => 'images/logo_inotal.png',
            'logo_footer' => 'images/inotal.png',
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('profiles');
    }
};
