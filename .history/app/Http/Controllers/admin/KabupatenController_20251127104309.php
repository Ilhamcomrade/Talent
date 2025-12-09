<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Regency;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');
        $perPage = request('per_page', 10);
        $provinceId = request('province_id');

        $regencies = Regency::with('province')
            ->where('status', true)
            ->when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->whereRaw('name ILIKE ?', ["%{$search}%"])
                      ->orWhereRaw('id ILIKE ?', ["%{$search}%"]);
                });
            })
            ->when($provinceId, function($query) use ($provinceId) {
                $query->where('province_id', $provinceId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        $provinces = Province::orderBy('name')->get();

        return view('admin.reference.kabupaten.index', compact('regencies', 'provinces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Province::orderBy('name')->get();
        return view('admin.reference.kabupaten.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'id' => 'required|string|max:10|unique:regencies,id',
            'name' => 'required|string|max:100',
            'status' => 'required|boolean',
        ]);

        try {
            DB::beginTransaction();

            Regency::create([
                'id' => $request->id,
                'province_id' => $request->province_id,
                'name' => $request->name,
                'status' => $request->status,
            ]);

            DB::commit();

            return redirect()->route('admin.reference.kabupaten.index')
                ->with('success', 'Kabupaten/Kota berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $regency = Regency::findOrFail($id);
        $provinces = Province::orderBy('name')->get();
        
        return view('admin.reference.kabupaten.edit', compact('regency', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $regency = Regency::findOrFail($id);

        $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:100',
            'status' => 'required|boolean',
        ]);

        try {
            DB::beginTransaction();

            $regency->update([
                'province_id' => $request->province_id,
                'name' => $request->name,
                'status' => (bool) $request->status,
            ]);

            DB::commit();

            return redirect()->route('admin.reference.kabupaten.index')
                ->with('success', 'Kabupaten/Kota berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $regency = Regency::findOrFail($id);
            $regency->delete();

            return redirect()->route('admin.reference.kabupaten.index')
                ->with('success', 'Kabupaten/Kota berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }    /**
     * Get kabupaten by provinsi for API
     */
    public function getKabupaten()
    {
        try {
            $regencies = Regency::with('province')
                ->orderBy('name')
                ->get(['id', 'name', 'province_id'])
                ->map(function($regency) {
                    return [
                        'id' => $regency->id,
                        'name' => $regency->name,
                        'province_id' => $regency->province_id,
                        'province_name' => $regency->province->name ?? 'Unknown'
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $regencies
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data kabupaten: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get kabupaten by provinsi for API
     */
    public function getByProvinsi($provinceId)
    {
        try {
            $regencies = Regency::with('province')
                ->where('province_id', $provinceId)
                ->orderBy('name')
                ->get(['id', 'name', 'province_id'])
                ->map(function($regency) {
                    return [
                        'id' => $regency->id,
                        'name' => $regency->name,
                        'province_id' => $regency->province_id,
                        'province_name' => $regency->province->name ?? 'Unknown'
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $regencies,
                'count' => count($regencies)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data kabupaten: ' . $e->getMessage()
            ], 500);
        }
    }
}