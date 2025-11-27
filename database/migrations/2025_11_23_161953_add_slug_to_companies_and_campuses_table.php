<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Company;
use App\Models\Campus;

return new class extends Migration
{
    public function up()
    {
        // Tambah kolom slug ke companies
        Schema::table('companies', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('nama_perusahaan');
        });

        // Tambah kolom slug ke campuses
        Schema::table('campuses', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('nama_kampus');
        });

        // Generate slug untuk data yang sudah ada
        $this->generateSlugsForExistingData();
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('campuses', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }

    private function generateSlugsForExistingData()
    {
        // Generate slug untuk companies yang sudah ada
        $companies = Company::all();
        foreach ($companies as $company) {
            $company->slug = Str::slug($company->nama_perusahaan);
            $company->save();
        }

        // Generate slug untuk campuses yang sudah ada
        $campuses = Campus::all();
        foreach ($campuses as $campus) {
            $campus->slug = Str::slug($campus->nama_kampus);
            $campus->save();
        }
    }
};
