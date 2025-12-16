<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class JobCategory extends Model
{
    use HasFactory;

    protected $table = 'job_categories';

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
    ];

    /**
     * AUTO SET SLUG saat name diisi
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    /**
     * RELASI: Child categories
     * Example: IT → (Frontend, Backend, DevOps)
     */
    public function children()
    {
        return $this->hasMany(JobCategory::class, 'parent_id');
    }

    /**
     * RELASI: Parent category
     * Example: Frontend → IT
     */
    public function parent()
    {
        return $this->belongsTo(JobCategory::class, 'parent_id');
    }

    /**
     * CEK apakah kategori adalah parent (tidak punya parent_id)
     */
    public function isParent()
    {
        return $this->parent_id === null;
    }

    /**
     * CEK apakah kategori adalah child
     */
    public function isChild()
    {
        return $this->parent_id !== null;
    }
}
