<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company',
        'company_id', // TAMBAHKAN INI
        'company_logo',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'desa_id',
        'salary_min',
        'salary_max',
        'type',
        'job_type',
        'work_policy',
        'experience_level',
        'education_level',
        'requirements',
        'skills',
        'qualifications',
        'deadline',
        'is_public',
        'description'
    ];

    protected $casts = [
        'deadline' => 'date',
        'is_public' => 'boolean',
        'salary_min' => 'integer',
        'salary_max' => 'integer',
    ];

    // Relasi ke tabel wilayah
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

    // Accessor untuk mendapatkan lokasi lengkap
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

    // Scope untuk lowongan yang aktif
    public function scopeActive($query)
    {
        return $query->where('is_public', true)
                    ->where(function($q) {
                        $q->whereNull('deadline')
                          ->orWhere('deadline', '>=', now());
                    });
    }

    // Accessor untuk gaji format
    public function getSalaryFormattedAttribute()
    {
        if ($this->salary_min && $this->salary_max) {
            return ' ' . number_format($this->salary_min, 0, ',', '.') . ' -  ' . number_format($this->salary_max, 0, ',', '.');
        } elseif ($this->salary_min) {
            return ' ' . number_format($this->salary_min, 0, ',', '.');
        } else {
            return 'Tidak Menampilkan Gaji';
        }
    }

    // Relasi ke tabel companies
    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class, 'company_id', 'id');
    }

    // Accessor untuk mendapatkan nama pengelola
    public function getPengelolaAttribute()
    {
        return $this->company ? $this->company->nama_lengkap : '-';
    }
}