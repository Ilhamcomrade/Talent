<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $fillable = [
        'name', 'code', 'description', 'type', 'status'
    ];

    // Jika menggunakan boolean untuk status
    public function getStatusAttribute($value)
    {
        return $value ? 'active' : 'inactive';
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value === 'active' || $value === true;
    }
}