<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kabupaten extends Model
{
    use HasFactory;

    protected $table = 'kabupatens';

    protected $fillable = [
        'provinsi_id',
        'kode_kabupaten',
        'nama_kabupaten',
        'jenis',
        'deskripsi',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    /**
     * Relasi ke Provinsi
     */
    public function provinsi(): BelongsTo
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }

    /**
     * Relasi ke Kecamatan
     */
    public function kecamatans(): HasMany
    {
        return $this->hasMany(Kecamatan::class, 'kabupaten_id');
    }

    /**
     * Scope untuk data aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope untuk filter by provinsi
     */
    public function scopeByProvinsi($query, $provinsiId)
    {
        return $query->where('provinsi_id', $provinsiId);
    }

    /**
     * Accessor untuk nama kabupaten dengan format title
     */
    public function getNamaKabupatenAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    /**
     * Mutator untuk kode kabupaten
     */
    public function setKodeKabupatenAttribute($value)
    {
        $this->attributes['kode_kabupaten'] = strtoupper($value);
    }
}