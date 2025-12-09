<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Regency;
use App\Models\Kecamatan;
use App\Models\Desa;

class LocationApiController extends \Illuminate\Routing\Controller
{
    /**
     * Get kabupaten by province
     */
    public function getKabupatenByProvince(Request $request): JsonResponse
    {
        $parentId = $request->input('parent_id');
        
        if (!$parentId) {
            return response()->json([]);
        }

        $regencies = Regency::where('province_id', $parentId)
            ->orderBy('name')
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'status' => $item->status,
                    'kode_kabupaten' => $item->id
                ];
            });

        return response()->json($regencies);
    }

    /**
     * Get kecamatan by kabupaten
     */
    public function getKecamatanByKabupaten(Request $request): JsonResponse
    {
        $parentId = $request->input('parent_id');
        
        if (!$parentId) {
            return response()->json([]);
        }

        $kecamatans = Kecamatan::where('kabupaten_id', $parentId)
            ->orderBy('nama_kecamatan')
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'nama_kecamatan' => $item->nama_kecamatan,
                    'kode_kecamatan' => $item->kode_kecamatan,
                    'status' => $item->status
                ];
            });

        return response()->json($kecamatans);
    }

    /**
     * Get desa by kecamatan
     */
    public function getDesaByKecamatan(Request $request): JsonResponse
    {
        $parentId = $request->input('parent_id');
        
        if (!$parentId) {
            return response()->json([]);
        }

        $desas = Desa::where('kecamatan_id', $parentId)
            ->orderBy('nama_desa')
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'nama_desa' => $item->nama_desa,
                    'kode_desa' => $item->kode_desa,
                    'status' => $item->status
                ];
            });

        return response()->json($desas);
    }
}
