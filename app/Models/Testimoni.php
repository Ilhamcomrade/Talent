<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'umur', // Ubah dari tanggal_lahir menjadi umur
        'pekerjaan',
        'kesan_pesan',
        'foto',
        'status'
    ];

    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return asset('storage/' . $this->foto);
        }
        return asset('images/default-avatar.png');
    }
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // Scope untuk mengambil testimoni berdasarkan tanggal dibuat (terbaru)
    public function scopeTerbaru($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Scope untuk limit
    public function scopeLimitTestimoni($query, $limit = 3)
    {
        return $query->limit($limit);
    }
}
