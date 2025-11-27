<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompaniesApplication extends Model
{
    use HasFactory;

    protected $table = 'companies_applications';

    protected $fillable = [
        'companies_id',
        'companies_job_id',
        'nama',
        'email',
        'telepon',
        'cv',
        'surat_lamaran',
        'catatan',
        'status'
    ];

    public function job()
    {
        return $this->belongsTo(CompaniesJob::class, 'companies_job_id');
    }
}
