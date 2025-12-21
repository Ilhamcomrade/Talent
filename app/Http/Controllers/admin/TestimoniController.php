<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonis = Testimoni::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.testimoni.index', compact('testimonis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimoni.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'umur' => 'required|integer|min:1|max:120', // Validasi umur sebagai angka
            'pekerjaan' => 'required|string|max:100',
            'kesan_pesan' => 'required|string|max:500',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $data = $request->only(['nama', 'umur', 'pekerjaan', 'kesan_pesan', 'status']);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('testimonis', 'public');
            $data['foto'] = $path;
        }

        Testimoni::create($data);

        return redirect()->route('admin.testimoni.index')
            ->with('success', 'Testimoni berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimoni $testimoni)
    {
        return view('admin.testimoni.show', compact('testimoni'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimoni $testimoni)
    {
        return view('admin.testimoni.edit', compact('testimoni'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimoni $testimoni)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'umur' => 'required|integer|min:1|max:120', // Validasi umur sebagai angka
            'pekerjaan' => 'required|string|max:100',
            'kesan_pesan' => 'required|string|max:500',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $data = $request->only(['nama', 'umur', 'pekerjaan', 'kesan_pesan', 'status']);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($testimoni->foto) {
                Storage::disk('public')->delete($testimoni->foto);
            }

            $path = $request->file('foto')->store('testimonis', 'public');
            $data['foto'] = $path;
        }

        $testimoni->update($data);

        return redirect()->route('admin.testimoni.index')
            ->with('success', 'Testimoni berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimoni $testimoni)
    {
        // Hapus foto jika ada
        if ($testimoni->foto) {
            Storage::disk('public')->delete($testimoni->foto);
        }

        $testimoni->delete();

        return redirect()->route('admin.testimoni.index')
            ->with('success', 'Testimoni berhasil dihapus!');
    }
}
