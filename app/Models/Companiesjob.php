<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompaniesJob extends Model
{
    protected $table = 'companiesjobs'; // Nama tabel

    protected $fillable = [
        'company_id',
        'company_name',
        'industry',
        'company_logo',
        'title',
        'job_level',
        'show_salary',
        'salary_min',
        'salary_max',
        'employment_type',
        'work_mode',
        'education_level',
        'experience',
        'skills',
        'requirements',
        'description',
        'tanggung_jawab',
        'kualifikasi',
        'nilai_tambah',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'desa_id',
    ];

    // 🔥 Supaya kolom JSON otomatis berubah menjadi array
    protected $casts = [
        'skills' => 'array',
        'show_salary' => 'boolean',
    ];

    /**
     * Relasi ke tabel perusahaan (jika mau dihubungkan)
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
