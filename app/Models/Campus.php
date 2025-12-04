<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Campus extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'campus';

    protected $fillable = [
        'nama_lengkap',
        'no_hp',
        'jabatan',
        'email',
        'password',
        'nama_kampus',
        'jumlah_pegawai',
        'jenis_institusi',
        'logo_path',
        'provinsi',
        'kota',
        'kecamatan',
        'desa_kelurahan',
        'alamat_lengkap',
        'is_active',
        'slug', // Tambahkan slug
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Boot method untuk generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($campus) {
            $campus->slug = Str::slug($campus->nama_kampus);
        });

        static::updating(function ($campus) {
            if ($campus->isDirty('nama_kampus')) {
                $campus->slug = Str::slug($campus->nama_kampus);
            }
        });
    }

    // Method untuk mendapatkan route key name (untuk route model binding)
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
