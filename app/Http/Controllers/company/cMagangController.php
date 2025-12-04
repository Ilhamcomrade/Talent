<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CompaniesMagang;

class cMagangController extends Controller
{
    /**
     * List data magang + search + pagination
     */
    public function index(Request $request)
    {
        $company = Auth::guard('company')->user();

        $search = $request->input('search');

        $magang = CompaniesMagang::where('company_id', $company->id)
            ->when($search, function($query) use ($search) {
                $query->where('title', 'like', "%$search%")
                      ->orWhere('lokasi', 'like', "%$search%")
                      ->orWhere('department', 'like', "%$search%");
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('company.magang.index', compact('magang', 'search'));
    }

    /**
     * Form create
     */
    public function create()
    {
        return view('company.magang.create');
    }

    /**
     * Store data magang
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required',
            'kualifikasi' => 'nullable',
            'tanggung_jawab' => 'nullable',
            'benefit' => 'nullable|string|max:255',
            'type' => 'required',
            'durasi' => 'nullable|string|max:100',
            'kuota' => 'required|integer',
            'gaji_min' => 'nullable|integer',
            'gaji_max' => 'nullable|integer',
            'deadline' => 'nullable|date',
            'status' => 'required',
        ]);

        $company = Auth::guard('company')->user();

        CompaniesMagang::create([
            'company_id' => $company->id,
            'title' => $request->title,
            'department' => $request->department,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'kualifikasi' => $request->kualifikasi,
            'tanggung_jawab' => $request->tanggung_jawab,
            'benefit' => $request->benefit,
            'type' => $request->type,
            'durasi' => $request->durasi,
            'kuota' => $request->kuota,
            'gaji_min' => $request->gaji_min,
            'gaji_max' => $request->gaji_max,
            'deadline' => $request->deadline,
            'status' => $request->status,
        ]);

        return redirect()->route('company.magang.index')
                        ->with('success', 'Lowongan magang berhasil dibuat!');
    }

    /**
     * Show detail
     */
    public function show($id)
    {
        $company = Auth::guard('company')->user();

        $magang = CompaniesMagang::where('company_id', $company->id)
                ->where('id', $id)
                ->firstOrFail();

        return view('company.magang.show', compact('magang'));
    }

    /**
     * Form edit
     */
    public function edit($id)
    {
        $company = Auth::guard('company')->user();

        $magang = CompaniesMagang::where('company_id', $company->id)
                ->where('id', $id)
                ->firstOrFail();

        return view('company.magang.edit', compact('magang'));
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required',
            'kualifikasi' => 'nullable',
            'tanggung_jawab' => 'nullable',
            'benefit' => 'nullable|string|max:255',
            'type' => 'required',
            'durasi' => 'nullable|string|max:100',
            'kuota' => 'required|integer',
            'gaji_min' => 'nullable|integer',
            'gaji_max' => 'nullable|integer',
            'deadline' => 'nullable|date',
            'status' => 'required',
        ]);

        $company = Auth::guard('company')->user();

        $magang = CompaniesMagang::where('company_id', $company->id)
                ->where('id', $id)
                ->firstOrFail();

        $magang->update($request->all());

        return redirect()->route('company.magang.index')
                        ->with('success', 'Lowongan magang berhasil diperbarui!');
    }

    /**
     * Delete data
     */
    public function destroy($id)
    {
        $company = Auth::guard('company')->user();

        $magang = CompaniesMagang::where('company_id', $company->id)
                ->where('id', $id)
                ->firstOrFail();

        $magang->delete();

        return back()->with('success', 'Lowongan magang berhasil dihapus!');
    }
}
