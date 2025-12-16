<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LocationApiController extends Controller
{
    /**
     * Get list of all active provinces
     * 
     * @return JsonResponse
     */
    public function getProvinsiList(): JsonResponse
    {
        $provinsi = Provinsi::where('status', 'aktif')
            ->orderBy('nama_provinsi')
            ->get(['id', 'nama_provinsi as name']);
        
        return response()->json($provinsi);
    }

    /**
     * Get kabupaten by province ID
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function getKabupatenByProvince(Request $request): JsonResponse
    {
        $parentId = $request->query('parent_id');

        if (!$parentId) {
            return response()->json([], 400);
        }

        $kabupaten = Kabupaten::where('provinsi_id', $parentId)
            ->where('status', 'aktif')
            ->orderBy('nama_kabupaten')
            ->get(['id', 'nama_kabupaten as name', 'provinsi_id']);

        return response()->json($kabupaten);
    }

    /**
     * Get kecamatan by kabupaten ID
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function getKecamatanByKabupaten(Request $request): JsonResponse
    {
        $parentId = $request->query('parent_id');

        if (!$parentId) {
            return response()->json([], 400);
        }

        $kecamatan = Kecamatan::where('kabupaten_id', $parentId)
            ->where('status', 'aktif')
            ->orderBy('nama_kecamatan')
            ->get(['id', 'nama_kecamatan as name', 'kabupaten_id']);

        return response()->json($kecamatan);
    }

    /**
     * Get desa by kecamatan ID
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function getDesaByKecamatan(Request $request): JsonResponse
    {
        $parentId = $request->query('parent_id');

        if (!$parentId) {
            return response()->json([], 400);
        }

        $desa = Desa::where('kecamatan_id', $parentId)
            ->where('status', 'aktif')
            ->orderBy('name')
            ->get(['id', 'name', 'kecamatan_id']);

        return response()->json($desa);
    }
}
