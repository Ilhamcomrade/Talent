<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Benefit;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $companyId = Auth::guard('company')->user()->id;

        $query = Benefit::where('company_id', $companyId);

        // Search functionality dengan case-insensitive
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(judul) LIKE ?', ['%' . strtolower($search) . '%'])
                    ->orWhereRaw('LOWER(deskripsi) LIKE ?', ['%' . strtolower($search) . '%']);
            });
        }

        $benefits = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('company.benefit.index', compact('benefits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.benefit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'deskripsi' => 'required|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $companyId = Auth::guard('company')->user()->id;

        // Handle file upload
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('benefit-icons', 'public');
            $validated['icon'] = $iconPath;
        }

        $validated['company_id'] = $companyId;

        Benefit::create($validated);

        return redirect()->route('company.benefits.index')
            ->with('success', 'Benefit berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Benefit $benefit)
    {
        // Authorization check
        $companyId = Auth::guard('company')->user()->id;
        if ($benefit->company_id != $companyId) {
            abort(403, 'Unauthorized action.');
        }

        return view('company.benefit.edit', compact('benefit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Benefit $benefit)
    {
        // Authorization check
        $companyId = Auth::guard('company')->user()->id;
        if ($benefit->company_id != $companyId) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'deskripsi' => 'required|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        // Handle file upload
        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($benefit->icon && Storage::disk('public')->exists($benefit->icon)) {
                Storage::disk('public')->delete($benefit->icon);
            }

            $iconPath = $request->file('icon')->store('benefit-icons', 'public');
            $validated['icon'] = $iconPath;
        }

        $benefit->update($validated);

        return redirect()->route('company.benefits.index')
            ->with('success', 'Benefit berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Benefit $benefit)
    {
        // Authorization check
        $companyId = Auth::guard('company')->user()->id;
        if ($benefit->company_id != $companyId) {
            abort(403, 'Unauthorized action.');
        }

        // Delete icon if exists
        if ($benefit->icon && Storage::disk('public')->exists($benefit->icon)) {
            Storage::disk('public')->delete($benefit->icon);
        }

        $benefit->delete();

        return redirect()->route('company.benefits.index')
            ->with('success', 'Benefit berhasil dihapus.');
    }

    /**
     * Toggle status benefit
     */
    public function toggleStatus(Benefit $benefit)
    {
        // Authorization check
        $companyId = Auth::guard('company')->user()->id;
        if ($benefit->company_id != $companyId) {
            abort(403, 'Unauthorized action.');
        }

        $benefit->update([
            'status' => $benefit->status === 'aktif' ? 'nonaktif' : 'aktif'
        ]);

        return redirect()->route('company.benefits.index')
            ->with('success', 'Status benefit berhasil diubah.');
    }
}
