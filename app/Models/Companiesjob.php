<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompaniesJob extends Model
{
    protected $table = 'companiesjobs';

    protected $fillable = [
        'company_id',
        'company_name',
        'industry',
        'job_category_id',
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
        'is_public',
    ];

    protected $casts = [
        'skills' => 'array',
        'show_salary' => 'boolean',
        'is_public' => 'boolean',
    ];

    /* ===============================
     *  RELASI KE PERUSAHAAN
     * =============================== */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    /* ===============================
     *  RELASI KE PELAMAR
     * =============================== */
    public function applicants()
    {
        return $this->hasMany(CompaniesApplication::class, 'companies_job_id', 'id');
    }

    /* ===============================
     *  RELASI KE KATEGORI PEKERJAAN
     * =============================== */
    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id', 'id');
    }

    /* ===============================
     *  RELASI WILAYAH BERTINGKAT
     * =============================== */
    public function province()
    {
        return $this->belongsTo(Province::class, 'provinsi_id', 'id');
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class, 'kabupaten_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'kecamatan_id', 'id');
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'desa_id', 'id');
    }

    /* ===============================
     *  ACCESSOR: LOKASI LENGKAP
     * =============================== */
    public function getFullLocationAttribute()
    {
        $parts = [];

        if ($this->village) {
            $parts[] = $this->village->name;
        }
        if ($this->district) {
            $parts[] = $this->district->name;
        }
        if ($this->regency) {
            $parts[] = $this->regency->name;
        }
        if ($this->province) {
            $parts[] = $this->province->name;
        }

        return implode(', ', $parts);
    }
}
