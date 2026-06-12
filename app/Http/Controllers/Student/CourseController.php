<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $studentProfile = Student::where('email', $user->email)->first();
        
        $semesterName = ($studentProfile->semester ?? '1st') . ' Semester';
        
        // Find course IDs that the student is enrolled in
        $enrolledCourseIds = $user->enrolledCourses()->pluck('course_id')->toArray();
        
        // Get courses: those in current semester OR those student has enrolled in
        $courses = Course::where('semester', $semesterName)
                         ->orWhereIn('id', $enrolledCourseIds)
                         ->latest()
                         ->get();
        
        return view('student.courses.index', compact('courses', 'semesterName', 'enrolledCourseIds'));
    }

    public function show(Course $course)
    {
        $user = auth()->user();
        $studentProfile = Student::where('email', $user->email)->first();
        
        $isEnrolled = false;
        $canEnroll = false;
        $isUpcoming = false;

        if ($studentProfile) {
            $studentSemesterNum = (int) preg_replace('/[^0-9]/', '', $studentProfile->semester);
            $courseSemesterNum = (int) preg_replace('/[^0-9]/', '', $course->semester);

            $isEnrolled = $user->enrolledCourses()->where('course_id', $course->id)->exists();

            if ($courseSemesterNum > $studentSemesterNum) {
                $isUpcoming = true;
            } else {
                $canEnroll = !$isEnrolled;
            }
        }

        return view('student.courses.show', compact('course', 'isEnrolled', 'canEnroll', 'isUpcoming', 'studentProfile'));
    }
}
