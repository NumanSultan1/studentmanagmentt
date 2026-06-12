<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class CoursePublicController extends Controller
{
    public function index()
    {
        // Get all courses and group by semester
        $groupedCourses = Course::latest()->get()->groupBy('semester');
        return view('public.courses.index', compact('groupedCourses'));
    }

    public function show(Course $course)
    {
        $isEnrolled = false;
        $canEnroll = false;
        $isUpcoming = false;
        $studentProfile = null;

        if (auth()->check() && auth()->user()->isStudent()) {
            $studentProfile = Student::where('email', auth()->user()->email)->first();
            if ($studentProfile) {
                $studentSemesterNum = (int) preg_replace('/[^0-9]/', '', $studentProfile->semester);
                $courseSemesterNum = (int) preg_replace('/[^0-9]/', '', $course->semester);

                $isEnrolled = auth()->user()->enrolledCourses()->where('course_id', $course->id)->exists();

                if ($courseSemesterNum > $studentSemesterNum) {
                    $isUpcoming = true;
                } else {
                    $canEnroll = !$isEnrolled;
                }
            }
        }

        return view('public.courses.show', compact('course', 'isEnrolled', 'canEnroll', 'isUpcoming', 'studentProfile'));
    }

    public function enroll(Request $request, Course $course)
    {
        $user = auth()->user();

        if (!$user->isStudent()) {
            return redirect()->back()->with('error', 'Only students can enroll in courses.');
        }

        $studentProfile = Student::where('email', $user->email)->first();
        if (!$studentProfile) {
            return redirect()->back()->with('error', 'Student profile not found.');
        }

        $studentSemesterNum = (int) preg_replace('/[^0-9]/', '', $studentProfile->semester);
        $courseSemesterNum = (int) preg_replace('/[^0-9]/', '', $course->semester);

        if ($courseSemesterNum > $studentSemesterNum) {
            return redirect()->back()->with('error', 'You cannot enroll in courses for an upcoming semester.');
        }

        if ($user->enrolledCourses()->where('course_id', $course->id)->exists()) {
            return redirect()->back()->with('warning', 'You are already enrolled in this course.');
        }

        $user->enrolledCourses()->attach($course->id);

        return redirect()->back()->with('success', 'Successfully enrolled in ' . $course->title . '!');
    }
}
