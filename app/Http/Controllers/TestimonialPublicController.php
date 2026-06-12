<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialPublicController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(6);
        return view('public.testimonials', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|min:10',
            'rating' => 'required|integer|min:1|max:5',
            'course' => 'nullable|string|max:255',
        ]);

        $user = auth()->user();

        Testimonial::create([
            'student_name' => $user->name,
            'student_image' => $user->profile_photo_path,
            'course' => $request->course,
            'content' => $request->content,
            'rating' => $request->rating,
            'is_featured' => false, // Default false until admin features it
        ]);

        return back()->with('success', 'Thank you! Your testimonial has been submitted and is awaiting review.');
    }
}
