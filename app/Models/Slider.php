<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'image'
    ];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            // Simpan langsung di public/images/sliders
            return asset('images/sliders/' . $this->image);
        }
        return null;
    }
}
