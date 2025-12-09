<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatans';

    protected $fillable = [
        'kabupaten_id',
        'kode_kecamatan',
        'nama_kecamatan',
        'deskripsi',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    /**
     * Relasi ke Kabupaten
     */
    public function kabupaten(): BelongsTo
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }

    /**
     * Relasi ke Desa
     */
    public function desas(): HasMany
    {
        return $this->hasMany(Desa::class, 'kecamatan_id');
    }

    /**
     * Scope untuk data aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope untuk filter by kabupaten
     */
    public function scopeByKabupaten($query, $kabupatenId)
    {
        return $query->where('kabupaten_id', $kabupatenId);
    }

    /**
     * Accessor untuk nama kecamatan dengan format title
     */
    public function getNamaKecamatanAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    /**
     * Mutator untuk kode kecamatan
     */
    public function setKodeKecamatanAttribute($value)
    {
        $this->attributes['kode_kecamatan'] = strtoupper($value);
    }
}