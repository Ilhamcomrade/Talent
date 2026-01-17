<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'email',
        'phone',
        'operation_hours',
        'latitude',
        'longitude',
        'map_popup_text',
        'logo_navbar_public',
        'logo_navbar_company',
        'logo_navbar_campus',
        'logo_footer',
    ];

    /**
     * Mutator untuk membersihkan input latitude
     * Menjaga presisi penuh tanpa pembulatan
     */
    public function setLatitudeAttribute($value)
    {
        if ($value !== null) {
            // Hapus spasi dan karakter non-numeric kecuali titik dan minus
            $cleaned = preg_replace('/[^0-9.\-]/', '', (string)$value);

            // Pastikan format valid
            if (preg_match('/^-?\d+(\.\d+)?$/', $cleaned)) {
                $this->attributes['latitude'] = $cleaned;
            } else {
                // Jika tidak valid, set null
                $this->attributes['latitude'] = null;
            }
        } else {
            $this->attributes['latitude'] = null;
        }
    }

    /**
     * Mutator untuk membersihkan input longitude
     * Menjaga presisi penuh tanpa pembulatan
     */
    public function setLongitudeAttribute($value)
    {
        if ($value !== null) {
            // Hapus spasi dan karakter non-numeric kecuali titik dan minus
            $cleaned = preg_replace('/[^0-9.\-]/', '', (string)$value);

            // Pastikan format valid
            if (preg_match('/^-?\d+(\.\d+)?$/', $cleaned)) {
                $this->attributes['longitude'] = $cleaned;
            } else {
                // Jika tidak valid, set null
                $this->attributes['longitude'] = null;
            }
        } else {
            $this->attributes['longitude'] = null;
        }
    }

    /**
     * Accessor untuk mendapatkan latitude sebagai float (jika diperlukan untuk perhitungan)
     */
    public function getLatitudeFloatAttribute()
    {
        return $this->latitude !== null ? (float)$this->latitude : null;
    }

    /**
     * Accessor untuk mendapatkan longitude sebagai float (jika diperlukan untuk perhitungan)
     */
    public function getLongitudeFloatAttribute()
    {
        return $this->longitude !== null ? (float)$this->longitude : null;
    }

    /**
     * Accessor untuk mendapatkan URL logo navbar public
     */
    public function getLogoNavbarPublicUrlAttribute()
    {
        if (!$this->logo_navbar_public) {
            return null;
        }

        // Jika logo disimpan di storage
        if (strpos($this->logo_navbar_public, 'storage/') === 0 || strpos($this->logo_navbar_public, 'logos/') === 0) {
            return asset('storage/' . $this->logo_navbar_public);
        }

        // Jika logo adalah path default dari migration
        if (strpos($this->logo_navbar_public, 'images/') === 0) {
            return asset($this->logo_navbar_public);
        }

        // Default: asumsikan di storage
        return asset('storage/' . $this->logo_navbar_public);
    }

    /**
     * Accessor untuk mendapatkan URL logo navbar company
     */
    public function getLogoNavbarCompanyUrlAttribute()
    {
        if (!$this->logo_navbar_company) {
            return null;
        }

        if (strpos($this->logo_navbar_company, 'storage/') === 0 || strpos($this->logo_navbar_company, 'logos/') === 0) {
            return asset('storage/' . $this->logo_navbar_company);
        }

        if (strpos($this->logo_navbar_company, 'images/') === 0) {
            return asset($this->logo_navbar_company);
        }

        return asset('storage/' . $this->logo_navbar_company);
    }

    /**
     * Accessor untuk mendapatkan URL logo navbar campus
     */
    public function getLogoNavbarCampusUrlAttribute()
    {
        if (!$this->logo_navbar_campus) {
            return null;
        }

        if (strpos($this->logo_navbar_campus, 'storage/') === 0 || strpos($this->logo_navbar_campus, 'logos/') === 0) {
            return asset('storage/' . $this->logo_navbar_campus);
        }

        if (strpos($this->logo_navbar_campus, 'images/') === 0) {
            return asset($this->logo_navbar_campus);
        }

        return asset('storage/' . $this->logo_navbar_campus);
    }

    /**
     * Accessor untuk mendapatkan URL logo footer
     */
    public function getLogoFooterUrlAttribute()
    {
        if (!$this->logo_footer) {
            return null;
        }

        if (strpos($this->logo_footer, 'storage/') === 0 || strpos($this->logo_footer, 'logos/') === 0) {
            return asset('storage/' . $this->logo_footer);
        }

        if (strpos($this->logo_footer, 'images/') === 0) {
            return asset($this->logo_footer);
        }

        return asset('storage/' . $this->logo_footer);
    }
}
