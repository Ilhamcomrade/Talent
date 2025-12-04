<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'judul',
        'deskripsi',
        'icon',
        'status'
    ];

    protected $casts = [
        'status' => 'string'
    ];

    // Relasi ke company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Scope untuk benefit aktif
    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }
}
