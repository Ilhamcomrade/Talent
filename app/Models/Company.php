<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        'kecamatan', // Kolom baru
        'desa_kelurahan', // Kolom baru
        'alamat_lengkap',
        'visi',
        'misi',
        'alasan',
        'is_active',
        // HAPUS: 'is_verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        // HAPUS: 'is_verified' => 'boolean',
    ];

    // Scope aktif
    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }

    // HAPUS: Scope terverifikasi
    // public function scopeTerverifikasi($query)
    // {
    //     return $query->where('is_verified', true);
    // }

    // Relasi ke JobListing (opsional)
    public function jobListings()
    {
        return $this->hasMany(JobListing::class);
    }
}