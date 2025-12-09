<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Regency;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegencyController extends Controller
{
    /**
     * Display a listing of regencies from API data
     */
    public function index()
    {
        $search = request('search');
        $perPage = request('per_page', 10);
        $provinceId = request('province_id');

        $regencies = Regency::with('province')
            ->when($search, function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('id', 'like', "%{$search}%");
            })
            ->when($provinceId, function($query) use ($provinceId) {
                $query->where('province_id', $provinceId);
            })
            ->orderBy('name')
            ->paginate($perPage);

        $provinces = Province::orderBy('name')->get();

        return view('admin.reference.kabupaten.index', compact('regencies', 'provinces'));
    }

    /**
     * Show the form for creating a new regency
     */
    public function create()
    {
        $provinces = Province::orderBy('name')->get();
        return view('admin.reference.kabupaten.create', compact('provinces'));
    }

    /**
     * Store a newly created regency
     */
    public function store(Request $request)
    {
        $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'id' => 'required|string|max:10|unique:regencies,id',
            'name' => 'required|string|max:100',
        ]);

        try {
            DB::beginTransaction();

            Regency::create([
                'id' => $request->id,
                'province_id' => $request->province_id,
                'name' => $request->name,
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
     * Show the form for editing the specified regency
     */
    public function edit(string $id)
    {
        $regency = Regency::findOrFail($id);
        $provinces = Province::orderBy('name')->get();
        
        return view('admin.reference.kabupaten.edit', compact('regency', 'provinces'));
    }

    /**
     * Update the specified regency
     */
    public function update(Request $request, string $id)
    {
        $regency = Regency::findOrFail($id);

        $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:100',
        ]);

        try {
            DB::beginTransaction();

            $regency->update([
                'province_id' => $request->province_id,
                'name' => $request->name,
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
     * Remove the specified regency
     */
    public function destroy(string $id)
    {
        $regency = Regency::findOrFail($id);

        try {
            DB::beginTransaction();

            // Check if regency has districts
            if ($regency->districts()->exists()) {
                return redirect()->back()
                    ->with('error', 'Tidak dapat menghapus kabupaten karena masih memiliki data kecamatan.');
            }

            $regency->delete();

            DB::commit();

            return redirect()->route('admin.reference.kabupaten.index')
                ->with('success', 'Kabupaten/Kota berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Get all regencies for API
     */
    public function getKabupaten()
    {
        try {
            $regencies = Regency::with('province')
                ->orderBy('name')
                ->get(['id', 'province_id', 'name']);

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
     * Get regencies by province for API
     */
    public function getByProvinsi($provinceId)
    {
        try {
            $regencies = Regency::where('province_id', $provinceId)
                ->orderBy('name')
                ->get(['id', 'province_id', 'name']);

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
}
