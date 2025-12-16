<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobCategoryController extends Controller
{
    /**
     * INDEX: Menampilkan semua parent + child
     */
    public function index()
    {
        $categories = JobCategory::whereNull('parent_id')
            ->with('children')
            ->orderBy('name')
            ->get();

        return view('admin.job_categories.index', compact('categories'));
    }

    /**
     * CREATE: Tampilkan form tambah kategori + parent list
     */
    public function create()
    {
        $parents = JobCategory::whereNull('parent_id')
            ->with('children')
            ->get();

        return view('admin.job_categories.create', compact('parents'));
    }

    /**
     * STORE: Simpan kategori baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'parent_id' => 'nullable|exists:job_categories,id',
        ]);

        $category = JobCategory::create([
            'name'      => $request->name,
            'slug'      => Str::slug($request->name),
            'parent_id' => $request->parent_id,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Kategori berhasil ditambahkan.',
                'data' => $category
            ]);
        }

        return redirect()
            ->route('admin.job-categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * EDIT: Form edit kategori (hanya child)
     */
    public function edit($id)
    {
        $category = JobCategory::findOrFail($id);

        // hanya child yang bisa pilih parent
        $parents = JobCategory::whereNull('parent_id')
            ->where('id', '!=', $id)
            ->get();

        return view('admin.job_categories.edit', compact('category', 'parents'));
    }

    /**
     * UPDATE: Update kategori
     */
    public function update(Request $request, $id)
    {
        $category = JobCategory::findOrFail($id);

        $request->validate([
            'name'      => 'required|string|max:255',
            'parent_id' => 'nullable|exists:job_categories,id',
        ]);

        if ($request->parent_id == $id) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Parent tidak boleh dirinya sendiri.'
                ], 422);
            }
            return back()->with('error', 'Parent tidak boleh dirinya sendiri.');
        }

        $category->update([
            'name'      => $request->name,
            'slug'      => Str::slug($request->name),
            'parent_id' => $request->parent_id,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Kategori berhasil diupdate.',
                'data' => $category
            ]);
        }

        return redirect()
            ->route('admin.job-categories.index')
            ->with('success', 'Kategori berhasil diupdate.');
    }

    /**
     * DELETE: Hapus kategori (parent + child) via AJAX
     */
    public function destroy(Request $request, $id)
    {
        $category = JobCategory::findOrFail($id);
        $category->delete();

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Kategori berhasil dihapus.'
            ]);
        }

        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}   
