<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Course;
use App\Models\Gallery;
use App\Models\Testimonial;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'students' => Student::count(),
            'courses' => Course::count(),
            'gallery' => Gallery::count(),
            'testimonials' => Testimonial::count(),
            'messages' => ContactMessage::count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
        ];

        $recentStudents = Student::latest()->take(5)->get();
        $recentMessages = ContactMessage::latest()->take(5)->get();
        $recentCourses = Course::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentStudents', 'recentMessages', 'recentCourses'));
    }
}
