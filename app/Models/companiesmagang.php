<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompaniesMagang extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'companiesmagang';

    // Field yang bisa diisi
    protected $fillable = [
        'company_id',
        'title',
        'department',
        'lokasi',
        'deskripsi',
        'kualifikasi',
        'tanggung_jawab',
        'benefit',
        'type',
        'durasi',
        'kuota',
        'gaji_min',
        'gaji_max',
        'deadline',
        'status',
    ];

    // Relasi ke perusahaan
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
