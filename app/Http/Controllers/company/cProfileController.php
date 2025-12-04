<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class cProfileController extends Controller
{
    // Tampilkan profil
    public function index()
    {
        $company = Auth::guard('company')->user();
        return view('company.profile.index', compact('company'));
    }

    // Tambah company (opsional untuk admin)
    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|max:255',
            'nama_lengkap' => 'required|max:255',
            'alamat_lengkap' => 'nullable|string',
            'jabatan' => 'required|max:255',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'required|email|unique:companies,email',
            'password' => 'required|min:6',
            'visi' => 'nullable|string', // Hapus max:255
            'misi' => 'nullable|string', // Hapus max:255
            'alasan' => 'nullable|string',
            'deskripsi_perusahaan' => 'nullable|string',
            'jumlah_karyawan' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'provinsi' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'desa_kelurahan' => 'nullable|string|max:255',
        ]);

        $company = new Company($request->except(['password', 'logo']));
        $company->password = Hash::make($request->password);

        if ($request->hasFile('logo')) {
            $company->logo = $request->file('logo')->store('company_logo', 'public');
        }

        $company->save();

        return redirect()->back()->with('success', 'Profil perusahaan berhasil ditambahkan.');
    }

    // Update profil
    public function update(Request $request)
    {
        /** @var \App\Models\Company $company */
        $company = Auth::guard('company')->user();

        $request->validate([
            'nama_perusahaan' => 'required|max:255',
            'nama_lengkap' => 'required|max:255',
            'alamat_lengkap' => 'nullable|string',
            'jabatan' => 'required|max:255',
            'no_hp' => 'nullable|string|max:20',
            'visi' => 'nullable|string', // Hapus max:255
            'misi' => 'nullable|string', // Hapus max:255
            'alasan' => 'nullable|string',
            'deskripsi_perusahaan' => 'nullable|string',
            'jumlah_karyawan' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'provinsi' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'desa_kelurahan' => 'nullable|string|max:255',
            'password' => 'nullable|min:6',
        ]);

        // Update semua kecuali password & logo
        $company->fill($request->except(['password', 'logo']));

        // Update logo jika ada upload baru
        if ($request->hasFile('logo')) {
            $company->logo = $request->file('logo')->store('company_logo', 'public');
        }

        // Update password jika diisi
        if ($request->filled('password')) {
            $company->password = Hash::make($request->password);
        }

        $company->save();

        return back()->with('success', 'Profil perusahaan berhasil diperbarui.');
    }

    // Hapus profil perusahaan
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->back()->with('success', 'Profil perusahaan berhasil dihapus.');
    }
}
