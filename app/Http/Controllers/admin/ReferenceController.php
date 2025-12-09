<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReferenceController extends Controller
{
    public function index(Request $request)
    {
        $reference = Reference::orderBy('id', 'DESC')->paginate(10);

        return view('admin.reference.index', compact('reference'));
    }

    public function create()
    {
        return view('admin.reference.create');
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|unique:references,code',
        'description' => 'nullable|string',
        'type' => 'required|string',
        'status' => 'required|boolean'
    ]);

        Reference::create([
        'title' => $validated['name'], // map name ke title
        'link' => $validated['code'],  // map code ke link
        'category' => $validated['type'], // map type ke category
        'status' => $validated['status'] ? 'active' : 'inactive'
    ]);


          return redirect()->route('admin.reference.index')
        ->with('success', 'Reference created successfully.');
    }
}
