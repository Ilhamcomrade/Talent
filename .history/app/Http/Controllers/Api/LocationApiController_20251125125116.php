<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\province;
use App\Models\regency;
use App\Models\District;
use App\Models\Village;
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
        $provinsi = province::orderBy('name')
            ->get(['id', 'name']);
        
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

        $kabupaten = regency::where('province_id', $parentId)
            ->orderBy('name')
            ->get(['id', 'name', 'province_id']);

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

        $kecamatan = District::where('regency_id', $parentId)
            ->orderBy('name')
            ->get(['id', 'name', 'regency_id']);

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

        $desa = Village::where('district_id', $parentId)
            ->orderBy('name')
            ->get(['id', 'name', 'district_id']);

        return response()->json($desa);
    }
}
