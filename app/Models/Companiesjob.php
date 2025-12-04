<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'is_public',
    ];

    protected $casts = [
        'skills' => 'array',
        'show_salary' => 'boolean',
        'is_public' => 'boolean',
    ];

    /**
     * Relasi ke tabel perusahaan
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * Relasi ke tabel provinsi
     */
    public function province()
    {
        return $this->belongsTo(Province::class, 'provinsi_id');
    }

    /**
     * Relasi ke tabel kabupaten/kota
     */
    public function regency()
    {
        return $this->belongsTo(Regency::class, 'kabupaten_id');
    }

    /**
     * Relasi ke tabel kecamatan
     */
    public function district()
    {
        return $this->belongsTo(District::class, 'kecamatan_id');
    }

    /**
     * Relasi ke tabel desa/kelurahan
     */
    public function village()
    {
        return $this->belongsTo(Village::class, 'desa_id');
    }

    /**
     * Accessor untuk mendapatkan lokasi lengkap
     */
    public function getFullLocationAttribute()
    {
        $locationParts = [];

        // Tambahkan desa jika ada
        if ($this->village) {
            $locationParts[] = $this->village->name;
        }

        // Tambahkan kecamatan jika ada
        if ($this->district) {
            $locationParts[] = $this->district->name;
        }

        // Tambahkan kabupaten/kota jika ada
        if ($this->regency) {
            $locationParts[] = $this->regency->name;
        }

        // Tambahkan provinsi jika ada
        if ($this->province) {
            $locationParts[] = $this->province->name;
        }

        if (!empty($locationParts)) {
            return implode(', ', $locationParts);
        }

        return 'Lokasi tidak ditentukan';
    }

    /**
     * Accessor untuk lokasi singkat (Kabupaten, Provinsi)
     */
    public function getShortLocationAttribute()
    {
        $locationParts = [];

        if ($this->regency) {
            $locationParts[] = $this->regency->name;
        }

        if ($this->province) {
            $locationParts[] = $this->province->name;
        }

        if (!empty($locationParts)) {
            return implode(', ', $locationParts);
        }

        return 'Lokasi tidak ditentukan';
    }

    /**
     * Accessor untuk waktu posting dalam format real-time
     */
    public function getPostedTimeAgoAttribute()
    {
        $createdAt = $this->created_at;
        $now = Carbon::now();

        // Hitung selisih waktu
        $diffInSeconds = $createdAt->diffInSeconds($now);
        $diffInMinutes = $createdAt->diffInMinutes($now);
        $diffInHours = $createdAt->diffInHours($now);
        $diffInDays = $createdAt->diffInDays($now);
        $diffInMonths = $createdAt->diffInMonths($now);
        $diffInYears = $createdAt->diffInYears($now);

        // Format berdasarkan selisih waktu
        if ($diffInSeconds < 60) {
            return "{$diffInSeconds} detik yang lalu";
        } elseif ($diffInMinutes < 60) {
            return "{$diffInMinutes} menit yang lalu";
        } elseif ($diffInHours < 24) {
            return "{$diffInHours} jam yang lalu";
        } elseif ($diffInDays < 30) {
            return "{$diffInDays} hari yang lalu";
        } elseif ($diffInMonths < 12) {
            return "{$diffInMonths} bulan yang lalu";
        } else {
            return "{$diffInYears} tahun yang lalu";
        }
    }
}
