<?php

namespace App\Http\Controllers\Campus;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use Illuminate\Http\Request;

class CampusController extends Controller
{
    /**
     * Menampilkan halaman detail kampus
     */
    public function show(Campus $campus)
    {
        try {
            // Pastikan kampus aktif
            if (!$campus->is_active) {
                abort(404, 'Kampus tidak ditemukan');
            }

            return view('detail_campus.detail_campus', compact('campus'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Kampus tidak ditemukan');
        }
    }

    /**
     * Menampilkan halaman culture/life kampus
     */
    public function culture(Campus $campus)
    {
        try {
            // Pastikan kampus aktif
            if (!$campus->is_active) {
                abort(404, 'Kampus tidak ditemukan');
            }

            return view('detail_campus.life_campus', compact('campus'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Kampus tidak ditemukan');
        }
    }

    public function prodi (Campus $campus) {
        try {

            if (!$campus->is_active) {
                 abort (404, 'Kampus tidak ditemukan');
            }

            return view('detail_campus.prodi_campus', compact('campus'));

        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort (404, 'Kampus tidak ditemukan');
        }
    }

        public function facility (Campus $campus) {
        try {

            if (!$campus->is_active) {
                 abort (404, 'Kampus tidak ditemukan');
            }

            return view('detail_campus.facility_campus', compact('campus'));

        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort (404, 'Kampus tidak ditemukan');
        }
    }

    /**
     * Menampilkan daftar semua kampus (untuk explore)
     */
    public function index()
    {
        return view('explore_company');
    }
}
