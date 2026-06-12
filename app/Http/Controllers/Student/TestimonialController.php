<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $myTestimonials = Testimonial::where('student_name', auth()->user()->name)->latest()->get();
        return view('student.testimonials.index', compact('myTestimonials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|min:10|max:1000',
        ]);

        $user = auth()->user();

        Testimonial::create([
            'student_name' => $user->name,
            'student_image' => $user->profile_photo_path,
            'course' => $validated['course'],
            'rating' => $validated['rating'],
            'content' => $validated['content'],
            'is_featured' => false,
        ]);

        return redirect()->back()->with('success', 'Your review has been submitted successfully and is pending approval.');
    }
}
