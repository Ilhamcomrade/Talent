<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Company extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $guard = 'company';
    protected $fillable = [
        'nama_lengkap',
        'no_hp',
        'jabatan',
        'email',
        'password',
        'nama_perusahaan',
        'jumlah_karyawan',
        'industri',
        'logo',
        'provinsi',
        'kota',
        'kecamatan',
        'desa_kelurahan',
        'alamat_lengkap',
        'visi',
        'misi',
        'alasan',
        'is_active',
        'slug', // Tambahkan slug
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Scope aktif
    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }

    // Boot method untuk generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($company) {
            $company->slug = Str::slug($company->nama_perusahaan);
        });

        static::updating(function ($company) {
            if ($company->isDirty('nama_perusahaan')) {
                $company->slug = Str::slug($company->nama_perusahaan);
            }
        });
    }

    // Relasi ke JobListing (opsional)
    public function jobListings()
    {
        return $this->hasMany(JobListing::class);
    }

    // Method untuk mendapatkan route key name (untuk route model binding)
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
