<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleryItems = Gallery::latest()->paginate(12);
        return view('admin.gallery.index', compact('galleryItems'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('gallery', 'public');
            
            Gallery::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'image_path' => $path,
            ]);
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Image uploaded and added to gallery successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image_path && !str_starts_with($gallery->image_path, 'http')) {
            Storage::disk('public')->delete($gallery->image_path);
        }
        
        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image deleted successfully.');
    }
}
