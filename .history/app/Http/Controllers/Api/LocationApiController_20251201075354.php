<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class LocationApiController extends Controller
{
    /**
     * Get list of aall active provinces
     * 
     * @return JsonResponse
     */
    public function getProvinsiList(): JsonResponse
    {
        $provinsi = Province::orderBy('name')
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

        $kabupaten = Regency::where('province_id', $parentId)
            ->orderBy('name')
            ->get(['id', 'name', 'province_id']);

        Log::info('Kabupaten query', [
            'province_id' => $parentId,
            'count' => $kabupaten->count(),
            'sample' => $kabupaten->first() ? $kabupaten->first()->toArray() : null
        ]);

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

    /**
     * Get kabupaten by province ID (Old system)
     * Used for reference forms (Kecamatan, Desa)
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function getKabupatenByProvinsi(Request $request): JsonResponse
    {
        $parentId = $request->query('parent_id');

        if (!$parentId) {
            return response()->json(['data' => [], 'error' => 'parent_id is required'], 400);
        }

        $kabupaten = Kabupaten::where('provinsi_id', $parentId)
            ->where('status', true)
            ->orderBy('nama_kabupaten')
            ->get(['id', 'nama_kabupaten as name', 'provinsi_id']);

        Log::info('Kabupaten (Old System) query', [
            'provinsi_id' => $parentId,
            'count' => $kabupaten->count(),
            'data' => $kabupaten->toArray()
        ]);

        return response()->json([
            'data' => $kabupaten,
            'count' => $kabupaten->count()
        ]);
    }

    /**
     * Get kecamatan by kabupaten ID (Old system)
     * Used for reference forms (Desa)
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function getKecamatanByKabupatenOld(Request $request): JsonResponse
    {
        $parentId = $request->query('parent_id');

        if (!$parentId) {
            return response()->json(['error' => 'parent_id is required'], 400);
        }

        $kecamatan = \App\Models\Kecamatan::where('kabupaten_id', $parentId)
            ->orderBy('nama_kecamatan')
            ->get(['id', 'nama_kecamatan as name', 'kabupaten_id']);

        Log::info('Kecamatan (Old System) query', [
            'kabupaten_id' => $parentId,
            'count' => $kecamatan->count(),
            'data' => $kecamatan->toArray()
        ]);

        return response()->json([
            'data' => $kecamatan,
            'count' => $kecamatan->count()
        ]);
    }
}
