<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function toggleFeature(Testimonial $testimonial)
    {
        $testimonial->is_featured = !$testimonial->is_featured;
        $testimonial->save();

        return back()->with('success', 'Testimonial status updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->student_image && !str_starts_with($testimonial->student_image, 'http')) {
            Storage::disk('public')->delete($testimonial->student_image);
        }
        
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
