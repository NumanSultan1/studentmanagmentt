<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredCourses = Course::where('is_featured', true)->take(3)->get();
        $testimonials = Testimonial::where('is_featured', true)->take(3)->get();
        
        $stats = [
            'students' => Student::count(),
            'courses' => Course::count(),
            'instructors' => Course::distinct('instructor')->count('instructor'),
            'satisfaction' => '98%'
        ];

        return view('public.home', compact('featuredCourses', 'testimonials', 'stats'));
    }
}
