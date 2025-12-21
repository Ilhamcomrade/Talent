<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Simpan di public/images/sliders
            $path = public_path('images/sliders');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }
            $image->move($path, $imageName);
        }

        Slider::create([
            'image' => $imageName
        ]);

        return redirect()->route('admin.slider.index')
            ->with('success', 'Slider berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048'
        ]);

        $slider = Slider::findOrFail($id);

        // Handle image update
        $imageName = $slider->image;
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            $oldImagePath = public_path('images/sliders/' . $slider->image);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // Upload gambar baru
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $path = public_path('images/sliders');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }
            $image->move($path, $imageName);

            $slider->update(['image' => $imageName]);
        }

        return redirect()->route('admin.slider.index')
            ->with('success', 'Slider berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        // Hapus gambar
        $imagePath = public_path('images/sliders/' . $slider->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $slider->delete();

        return redirect()->route('admin.slider.index')
            ->with('success', 'Slider berhasil dihapus.');
    }
}
