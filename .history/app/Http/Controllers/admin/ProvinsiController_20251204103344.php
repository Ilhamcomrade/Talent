<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $perPage = $request->get('per_page', 10);

        $provinces = Province::query()
            ->where('status', true)
            ->when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->whereRaw('name ILIKE ?', ["%{$search}%"])
                      ->orWhereRaw('id ILIKE ?', ["%{$search}%"]);
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return view('admin.reference.provinsi.index', [
            'title' => 'Manajemen Provinsi',
            'provinces' => $provinces
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.reference.provinsi.create', [
            'title' => 'Tambah Provinsi'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|string|max:10|unique:provinces,id',
            'name' => 'required|string|max:100',
            'status' => 'required|in:0,1',
        ]);

        Province::create([
            'id' => $request->id,
            'name' => $request->name,
            'status' => (bool) $request->status,
        ]);

        return redirect()->route('admin.reference.provinsi.index')
            ->with('success', 'Provinsi berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $province = Province::findOrFail($id);

        return view('admin.reference.provinsi.edit', [
            'title' => 'Edit Provinsi',
            'province' => $province,
            'provinces' => []
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $province = Province::findOrFail($id);

        $request->validate([
            'id' => 'required|string|max:10|unique:provinces,id,' . $id,
            'name' => 'required|string|max:100',
            'status' => 'required|in:0,1',
        ]);

        $province->update([
            'id' => $request->id,
            'name' => $request->name,
            'status' => (bool) $request->status,
        ]);

        return redirect()->route('admin.reference.provinsi.index')
            ->with('success', 'Provinsi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $province = Province::findOrFail($id);
            
            // Delete the province (cascade will handle related records)
            $province->delete();

            return redirect()->route('admin.reference.provinsi.index')
                ->with('success', 'Provinsi berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus: ' . $e->getMessage());
        }
    }
}

