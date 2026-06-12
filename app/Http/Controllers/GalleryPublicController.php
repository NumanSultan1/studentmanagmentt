<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryPublicController extends Controller
{
    public function index()
    {
        $galleryItems = Gallery::latest()->get();
        return view('public.gallery', compact('galleryItems'));
    }
}
