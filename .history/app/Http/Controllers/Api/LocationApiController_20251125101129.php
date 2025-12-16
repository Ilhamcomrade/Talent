<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;

class LocationApiController extends Controller
{
    /**
     * Get all active Provinces
     */
    public function getProvinsiList(Request $request)
    {
        $provinsi = Province::where('status', 1)
            ->orderBy('name')
            ->get(['id', 'name', 'status'])
            ->toArray();

        return response()->json($provinsi);
    }

    /**
     * Get Kabupaten by Province ID
     */
    public function getKabupatenByProvince(Request $request)
    {
        $provinceId = $request->query('parent_id');
        
        if (!$provinceId) {
            return response()->json([], 400);
        }

        $kabupaten = Kabupaten::where('province_id', $provinceId)
            ->where('status', 1)
            ->orderBy('name')
            ->get(['id', 'name', 'status'])
            ->toArray();

        return response()->json($kabupaten);
    }

    /**
     * Get Kecamatan by Kabupaten ID
     */
    public function getKecamatanByKabupaten(Request $request)
    {
        $kabupatenId = $request->query('parent_id');
        
        if (!$kabupatenId) {
            return response()->json([], 400);
        }

        $kecamatan = Kecamatan::where('kabupaten_id', $kabupatenId)
            ->where('status', 1)
            ->orderBy('nama_kecamatan')
            ->get(['id', 'nama_kecamatan as name', 'kode_kecamatan as code', 'status'])
            ->toArray();

        return response()->json($kecamatan);
    }

    /**
     * Get Desa by Kecamatan ID
     */
    public function getDesaByKecamatan(Request $request)
    {
        $kecamatanId = $request->query('parent_id');
        
        if (!$kecamatanId) {
            return response()->json([], 400);
        }

        $desa = Desa::where('kecamatan_id', $kecamatanId)
            ->where('status', 1)
            ->orderBy('nama_desa')
            ->get(['id', 'nama_desa as name', 'kode_desa as code', 'status'])
            ->toArray();

        return response()->json($desa);
    }
}
