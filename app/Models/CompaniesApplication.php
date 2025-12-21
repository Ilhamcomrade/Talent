<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompaniesApplication extends Model
{
    use HasFactory;

    protected $table = 'companies_applications';

    protected $fillable = [
        'company_id',
        'companies_job_id',

        // Profile
        'nama',
        'email',
        'telepon',
        'tgl_lahir',
        'alamat',

        // Berkas
        'cv',
        'surat_lamaran',
        'foto',
        'ijazah',

        // Wawancara
        'pendidikan',
        'asal_sekolah',
        'pengalaman_kerja',
        'link_wawancara',
        'tanggal_wawancara',
        'desk_wawancara',

        // Tes Dev
        'keahlian',
        'desk_tes',
        'link_tugas',

        // Lain-lain
        'catatan',
        'status',
        'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'tgl_lahir' => 'date',
        'tanggal_wawancara' => 'date'
    ];

    /**
     * Relasi ke job yang dilamar
     */
    public function job()
    {
        return $this->belongsTo(CompaniesJob::class, 'companies_job_id');
    }

    /**
     * Relasi ke perusahaan
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    
    // ==========================================================
    // !!! BAGIAN INI ADALAH PERBAIKAN UNTUK MENGATASI ERROR !!!
    // ==========================================================

    /**
     * Mengembalikan array daftar status aplikasi yang valid.
     * Metode ini diperlukan jika Anda memanggil CompaniesApplication::getValidStatuses().
     *
     * @return array
     */
    public static function getValidStatuses(): array
    {
        // Anda dapat menyesuaikan status dan label ini sesuai dengan alur rekrutmen Anda.
        return [
            'pending' => 'Menunggu Review',
            'reviewed' => 'Sedang Diproses',
            'interview' => 'Dipanggil Interview',
            'hrd_interview' => 'Interview HRD', // Contoh status tambahan
            'user_interview' => 'Interview User', // Contoh status tambahan
            'test' => 'Tes Khusus/Dev', // Sesuai dengan field 'desk_tes'
            'accepted' => 'Diterima',
            'rejected' => 'Ditolak',
        ];
    }
}