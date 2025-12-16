<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');
        $perPage = request('per_page', 10);
        $kecamatanId = request('kecamatan_id');

        $desas = Desa::with(['kecamatan', 'kecamatan.kabupaten', 'kecamatan.kabupaten.provinsi'])
            ->when($search, function($query) use ($search) {
                $searchUpper = strtoupper($search);
                $query->whereRaw("UPPER(nama_desa) like ?", ["%{$searchUpper}%"])
                      ->orWhere('kode_desa', 'like', "%{$search}%");
            })
            ->when($kecamatanId, function($query) use ($kecamatanId) {
                $query->where('kecamatan_id', $kecamatanId);
            })
            ->orderBy('nama_desa')
            ->paginate($perPage);

        $kecamatans = Kecamatan::with(['kabupaten', 'kabupaten.provinsi'])
            ->where('status', true)
            ->orderBy('nama_kecamatan')
            ->get();

        return view('admin.reference.desa.index', compact('desas', 'kecamatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kecamatans = Kecamatan::with(['kabupaten', 'kabupaten.provinsi'])
            ->where('status', true)
            ->orderBy('nama_kecamatan')
            ->get();

        return view('admin.reference.desa.create', compact('kecamatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kecamatan_id' => 'required|exists:kecamatans,id',
            'kode_desa' => 'required|string|max:10|unique:desas,kode_desa',
            'nama_desa' => 'required|string|max:100',
            'jenis' => 'required|in:Desa,Kelurahan',
            'kodepos' => 'nullable|string|max:10',
            'deskripsi' => 'nullable|string|max:500',
            'status' => 'required|boolean',
        ]);

        try {
            DB::beginTransaction();

            Desa::create([
                'kecamatan_id' => $request->kecamatan_id,
                'kode_desa' => $request->kode_desa,
                'nama_desa' => $request->nama_desa,
                'jenis' => $request->jenis,
                'kodepos' => $request->kodepos,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ]);

            DB::commit();

            return redirect()->route('admin.reference.desa.index')
                ->with('success', 'Desa/Kelurahan berhasil ditambahkan.');

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
        $desa = Desa::findOrFail($id);
        $kecamatans = Kecamatan::with(['kabupaten', 'kabupaten.provinsi'])
            ->where('status', true)
            ->orderBy('nama_kecamatan')
            ->get();

        return view('admin.reference.desa.edit', compact('desa', 'kecamatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $desa = Desa::findOrFail($id);

        $request->validate([
            'kecamatan_id' => 'required|exists:kecamatans,id',
            'kode_desa' => 'required|string|max:10|unique:desas,kode_desa,' . $id,
            'nama_desa' => 'required|string|max:100',
            'jenis' => 'required|in:Desa,Kelurahan',
            'kodepos' => 'nullable|string|max:10',
            'deskripsi' => 'nullable|string|max:500',
            'status' => 'required|boolean',
        ]);

        try {
            DB::beginTransaction();

            $desa->update([
                'kecamatan_id' => $request->kecamatan_id,
                'kode_desa' => $request->kode_desa,
                'nama_desa' => $request->nama_desa,
                'jenis' => $request->jenis,
                'kodepos' => $request->kodepos,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ]);

            DB::commit();

            return redirect()->route('admin.reference.desa.index')
                ->with('success', 'Desa/Kelurahan berhasil diperbarui.');

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
        $desa = Desa::findOrFail($id);

        try {
            DB::beginTransaction();

            $desa->delete();

            DB::commit();

            return redirect()->route('admin.reference.desa.index')
                ->with('success', 'Desa/Kelurahan berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Get all desa for API - returns data with configurable limit
     */
    public function getDesa()
    {
        try {
            // Get limit from query or default to 5000
            $limit = request('limit', 5000);
            $limit = min((int)$limit, 5000); // Max 5000 records per request
            
            $desas = Desa::with(['kecamatan', 'kecamatan.kabupaten', 'kecamatan.kabupaten.provinsi'])
                ->where('status', true)
                ->orderBy('nama_desa')
                ->limit($limit)
                ->get(['id', 'kode_desa', 'nama_desa', 'jenis', 'kodepos', 'kecamatan_id']);

            return response()->json([
                'success' => true,
                'count' => $desas->count(),
                'data' => $desas
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data desa: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get desa by kecamatan for API
     */
    public function getByKecamatan($kecamatanId)
    {
        try {
            $limit = request('limit', 1000);
            $limit = min((int)$limit, 1000); // Max 1000 records per kecamatan
            
            $desas = Desa::where('kecamatan_id', $kecamatanId)
                ->where('status', true)
                ->orderBy('nama_desa')
                ->limit($limit)
                ->get(['id', 'kode_desa', 'nama_desa', 'jenis', 'kodepos']);

            return response()->json([
                'success' => true,
                'count' => $desas->count(),
                'data' => $desas
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data desa: ' . $e->getMessage()
            ], 500);
        }
    }
}