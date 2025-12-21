<?php

namespace App\Http\Controllers;

use App\Models\CompaniesMagang; // Ganti dari Magang ke CompaniesMagang
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Http\Request;

class intersipController extends Controller
{
    /**
     * Tampilkan daftar lowongan magang ke publik
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $provinsi = $request->input('provinsi');
        $kabupaten = $request->input('kabupaten');

        $magang = CompaniesMagang::with(['company'])
            ->where('status', 'aktif') // Sesuaikan dengan status di CompaniesMagang
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%$search%")
                      ->orWhereHas('company', function ($companyQuery) use ($search) {
                          $companyQuery->where('nama_perusahaan', 'like', "%$search%");
                      });
                });
            })
            ->latest()
            ->paginate(9);

        $provinces = Province::all();

        return view('magang.index', compact('magang', 'provinces', 'search', 'provinsi', 'kabupaten'));
    }

    /**
     * Tampilkan detail satu lowongan magang
     */
    public function show($id)
    {
        $magang = CompaniesMagang::with(['company'])
            ->where('status', 'aktif')
            ->findOrFail($id);

        return view('magang.show', compact('magang'));
    }

    /**
     * API Lokasi Dinamis (untuk dropdown AJAX publik)
     */
    public function getRegencies($province_id)
    {
        return response()->json(Regency::where('province_id', $province_id)->get());
    }

    public function getDistricts($regency_id)
    {
        return response()->json(District::where('regency_id', $regency_id)->get());
    }

    public function getVillages($district_id)
    {
        return response()->json(Village::where('district_id', $district_id)->get());
    }
}