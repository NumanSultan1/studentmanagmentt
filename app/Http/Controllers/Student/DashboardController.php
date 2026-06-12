<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Find if this user is in the students table by email
        $studentProfile = Student::where('email', $user->email)->first();
        
        $semesterName = ($studentProfile->semester ?? '1st') . ' Semester';

        $enrolledCourseIds = $user->enrolledCourses()->pluck('course_id')->toArray();

        $stats = [
            'total_courses' => Course::where('semester', $semesterName)->orWhereIn('id', $enrolledCourseIds)->count(),
            'my_enrolled_courses' => count($enrolledCourseIds),
            'my_reviews' => Testimonial::where('student_name', $user->name)->count(),
        ];

        $recentCourses = Course::where('semester', $semesterName)->orWhereIn('id', $enrolledCourseIds)->latest()->take(3)->get();

        return view('student.dashboard', compact('user', 'studentProfile', 'stats', 'recentCourses', 'enrolledCourseIds'));
    }
}
