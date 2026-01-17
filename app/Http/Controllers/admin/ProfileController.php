<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::first();

        if (!$profile) {
            $profile = Profile::create([
                'address' => 'Jl. Pratista Utara III No.2, Antapani Kidul, Kec. Antapani, Kota Bandung, Jawa Barat, Indonesia 4029',
                'email' => 'corporate@inotal.tech',
                'phone' => '+(62) 82115179879',
                'operation_hours' => 'Senin - Jumat, 08.00 - 16.00 WIB',
                'latitude' =>  '-6.925457980196308',
                'longitude' =>   '107.66299344598612',
                'map_popup_text' => 'PT INOTAL SISTEMA INTERNASIONAL Jl. Pratista Utara III No.2, Antapani.',
                'logo_navbar_public' => 'images/logo_inotal.png',
                'logo_navbar_company' => 'images/logo_inotal.png',
                'logo_navbar_campus' => 'images/logo_inotal.png',
                'logo_footer' => 'images/inotal.png',
            ]);
        }

        return view('admin.profile.index', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = Profile::firstOrFail();

        $validated = $request->validate([
            // Informasi Kontak
            'address' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'operation_hours' => 'required|string',

            // Lokasi Perusahaan - UBAH VALIDASI
            'latitude' => [
                'required',
                'regex:/^-?\d+(\.\d+)?$/',
                'max:50'
            ],
            'longitude' => [
                'required',
                'regex:/^-?\d+(\.\d+)?$/',
                'max:50'
            ],
            'map_popup_text' => 'nullable|string',

            // Logo - validasi untuk file upload
            'logo_navbar_public' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'logo_navbar_company' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'logo_navbar_campus' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'logo_footer' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

            // Fields untuk hapus logo
            'remove_logo_navbar_public' => 'nullable|boolean',
            'remove_logo_navbar_company' => 'nullable|boolean',
            'remove_logo_navbar_campus' => 'nullable|boolean',
            'remove_logo_footer' => 'nullable|boolean',
        ], [
            'latitude.regex' => 'Latitude hanya boleh berisi angka, titik desimal, dan tanda minus.',
            'longitude.regex' => 'Longitude hanya boleh berisi angka, titik desimal, dan tanda minus.',
        ]);

        // Handle upload logo navbar public
        if ($request->hasFile('logo_navbar_public')) {
            // Hapus file lama jika ada (kecuali file default)
            if ($profile->logo_navbar_public &&
                strpos($profile->logo_navbar_public, 'logos/') === 0 &&
                Storage::disk('public')->exists($profile->logo_navbar_public)) {
                Storage::disk('public')->delete($profile->logo_navbar_public);
            }

            // Simpan file baru
            $path = $request->file('logo_navbar_public')->store('logos', 'public');
            $validated['logo_navbar_public'] = $path;
        } elseif ($request->has('remove_logo_navbar_public')) {
            // Hapus file jika checkbox dicentang (kecuali file default)
            if ($profile->logo_navbar_public &&
                strpos($profile->logo_navbar_public, 'logos/') === 0 &&
                Storage::disk('public')->exists($profile->logo_navbar_public)) {
                Storage::disk('public')->delete($profile->logo_navbar_public);
            }
            $validated['logo_navbar_public'] = null;
        } else {
            // Jaga file yang sudah ada
            unset($validated['logo_navbar_public']);
        }

        // Handle upload logo navbar company
        if ($request->hasFile('logo_navbar_company')) {
            if ($profile->logo_navbar_company &&
                strpos($profile->logo_navbar_company, 'logos/') === 0 &&
                Storage::disk('public')->exists($profile->logo_navbar_company)) {
                Storage::disk('public')->delete($profile->logo_navbar_company);
            }

            $path = $request->file('logo_navbar_company')->store('logos', 'public');
            $validated['logo_navbar_company'] = $path;
        } elseif ($request->has('remove_logo_navbar_company')) {
            if ($profile->logo_navbar_company &&
                strpos($profile->logo_navbar_company, 'logos/') === 0 &&
                Storage::disk('public')->exists($profile->logo_navbar_company)) {
                Storage::disk('public')->delete($profile->logo_navbar_company);
            }
            $validated['logo_navbar_company'] = null;
        } else {
            unset($validated['logo_navbar_company']);
        }

        // Handle upload logo navbar campus
        if ($request->hasFile('logo_navbar_campus')) {
            if ($profile->logo_navbar_campus &&
                strpos($profile->logo_navbar_campus, 'logos/') === 0 &&
                Storage::disk('public')->exists($profile->logo_navbar_campus)) {
                Storage::disk('public')->delete($profile->logo_navbar_campus);
            }

            $path = $request->file('logo_navbar_campus')->store('logos', 'public');
            $validated['logo_navbar_campus'] = $path;
        } elseif ($request->has('remove_logo_navbar_campus')) {
            if ($profile->logo_navbar_campus &&
                strpos($profile->logo_navbar_campus, 'logos/') === 0 &&
                Storage::disk('public')->exists($profile->logo_navbar_campus)) {
                Storage::disk('public')->delete($profile->logo_navbar_campus);
            }
            $validated['logo_navbar_campus'] = null;
        } else {
            unset($validated['logo_navbar_campus']);
        }

        // Handle upload logo footer
        if ($request->hasFile('logo_footer')) {
            if ($profile->logo_footer &&
                strpos($profile->logo_footer, 'logos/') === 0 &&
                Storage::disk('public')->exists($profile->logo_footer)) {
                Storage::disk('public')->delete($profile->logo_footer);
            }

            $path = $request->file('logo_footer')->store('logos', 'public');
            $validated['logo_footer'] = $path;
        } elseif ($request->has('remove_logo_footer')) {
            if ($profile->logo_footer &&
                strpos($profile->logo_footer, 'logos/') === 0 &&
                Storage::disk('public')->exists($profile->logo_footer)) {
                Storage::disk('public')->delete($profile->logo_footer);
            }
            $validated['logo_footer'] = null;
        } else {
            unset($validated['logo_footer']);
        }

        // Hapus field remove_* dari array validated
        unset(
            $validated['remove_logo_navbar_public'],
            $validated['remove_logo_navbar_company'],
            $validated['remove_logo_navbar_campus'],
            $validated['remove_logo_footer']
        );

        // Update data profile
        $profile->update($validated);

        // Clear view cache untuk memastikan perubahan langsung terlihat
        if (app()->environment('local')) {
            Artisan::call('view:clear');
        }

        return redirect()->route('admin.profile.index')
            ->with('success', 'Profil berhasil diperbarui! Logo akan langsung terupdate di semua halaman.');
    }
}
