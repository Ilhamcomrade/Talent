<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');
        $perPage = request('per_page', 10);
        $kabupatenId = request('kabupaten_id');

        $kecamatans = Kecamatan::with(['kabupaten', 'kabupaten.provinsi'])
            ->when($search, function($query) use ($search) {
                $searchUpper = strtoupper($search);
                $searchLower = strtolower($search);
                $query->whereRaw("UPPER(nama_kecamatan) like ?", ["%{$searchUpper}%"])
                      ->orWhere('kode_kecamatan', 'like', "%{$search}%");
            })
            ->when($kabupatenId, function($query) use ($kabupatenId) {
                $query->where('kabupaten_id', $kabupatenId);
            })
            ->orderBy('nama_kecamatan')
            ->paginate($perPage);

        $kabupatens = Kabupaten::with('provinsi')
            ->where('status', true)
            ->orderBy('nama_kabupaten')
            ->get();

        return view('admin.reference.kecamatan.index', compact('kecamatans', 'kabupatens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kabupatens = Kabupaten::with('provinsi')
            ->where('status', true)
            ->orderBy('nama_kabupaten')
            ->get();

        return view('admin.reference.kecamatan.create', compact('kabupatens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kabupaten_id' => 'required|exists:kabupatens,id',
            'kode_kecamatan' => 'required|string|max:10|unique:kecamatans,kode_kecamatan',
            'nama_kecamatan' => 'required|string|max:100',
            'deskripsi' => 'nullable|string|max:500',
            'status' => 'required|boolean',
        ]);

        try {
            DB::beginTransaction();

            Kecamatan::create([
                'kabupaten_id' => $request->kabupaten_id,
                'kode_kecamatan' => $request->kode_kecamatan,
                'nama_kecamatan' => $request->nama_kecamatan,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ]);

            DB::commit();

            return redirect()->route('admin.reference.kecamatan.index')
                ->with('success', 'Kecamatan berhasil ditambahkan.');

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
        $kecamatan = Kecamatan::findOrFail($id);
        $kabupatens = Kabupaten::with('provinsi')
            ->where('status', true)
            ->orderBy('nama_kabupaten')
            ->get();

        return view('admin.reference.kecamatan.edit', compact('kecamatan', 'kabupatens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kecamatan = Kecamatan::findOrFail($id);

        $request->validate([
            'kabupaten_id' => 'required|exists:kabupatens,id',
            'kode_kecamatan' => 'required|string|max:10|unique:kecamatans,kode_kecamatan,' . $id,
            'nama_kecamatan' => 'required|string|max:100',
            'deskripsi' => 'nullable|string|max:500',
            'status' => 'required|boolean',
        ]);

        try {
            DB::beginTransaction();

            $kecamatan->update([
                'kabupaten_id' => $request->kabupaten_id,
                'kode_kecamatan' => $request->kode_kecamatan,
                'nama_kecamatan' => $request->nama_kecamatan,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ]);

            DB::commit();

            return redirect()->route('admin.reference.kecamatan.index')
                ->with('success', 'Kecamatan berhasil diperbarui.');

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
            $kecamatan = Kecamatan::findOrFail($id);
            $kecamatan->delete();

            return redirect()->route('admin.reference.kecamatan.index')
                ->with('success', 'Kecamatan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Get kecamatan by kabupaten for API
     */
    public function getKecamatan()
    {
        try {
            $kecamatans = Kecamatan::with(['kabupaten', 'kabupaten.provinsi'])
                ->where('status', true)
                ->orderBy('nama_kecamatan')
                ->get(['id', 'kode_kecamatan', 'nama_kecamatan', 'kabupaten_id']);

            return response()->json([
                'success' => true,
                'data' => $kecamatans
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data kecamatan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get kecamatan by kabupaten for API
     */
    public function getByKabupaten($kabupatenId)
    {
        try {
            $kecamatans = Kecamatan::where('kabupaten_id', $kabupatenId)
                ->where('status', true)
                ->orderBy('nama_kecamatan')
                ->get(['id', 'kode_kecamatan', 'nama_kecamatan']);

            return response()->json([
                'success' => true,
                'data' => $kecamatans
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data kecamatan: ' . $e->getMessage()
            ], 500);
        }
    }
}