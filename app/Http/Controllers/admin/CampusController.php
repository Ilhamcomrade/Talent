<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CampusController extends Controller
{
    public function index()
    {
        $campuses = Campus::latest()->paginate(10);
        return view('admin.campus.index', compact('campuses'));
    }

    public function show($slug) // Ubah parameter menjadi slug
    {
        // Cari kampus berdasarkan slug
        $campus = Campus::where('slug', $slug)->firstOrFail();
        return view('admin.campus.show', compact('campus'));
    }

    public function destroy($slug) // Ubah parameter menjadi slug
    {
        // Cari kampus berdasarkan slug
        $campus = Campus::where('slug', $slug)->firstOrFail();

        // Delete logo file if exists
        if ($campus->logo_path && Storage::disk('public')->exists($campus->logo_path)) {
            Storage::disk('public')->delete($campus->logo_path);
        }

        $campus->delete();

        return redirect()->route('admin.campus.index')
            ->with('success', 'Kampus berhasil dihapus');
    }
}
