<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseEnrollmentTest extends TestCase
{
    use RefreshDatabase;

    private User $studentUser;
    private Student $studentProfile;
    private Course $pastCourse;
    private Course $currentCourse;
    private Course $upcomingCourse;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a student user in 2nd Semester
        $this->studentUser = User::factory()->create([
            'email' => 'student@example.com',
            'role' => 'student',
        ]);

        $this->studentProfile = Student::create([
            'name' => $this->studentUser->name,
            'email' => $this->studentUser->email,
            'semester' => '2nd',
            'department' => 'Computer Science',
        ]);

        // Create courses for different semesters
        $this->pastCourse = Course::create([
            'title' => 'Calculus I',
            'instructor' => 'Prof. Calculus',
            'semester' => '1st Semester',
            'description' => 'Introductory calculus course.',
        ]);

        $this->currentCourse = Course::create([
            'title' => 'OOP Java',
            'instructor' => 'Prof. Java',
            'semester' => '2nd Semester',
            'description' => 'Object oriented programming.',
        ]);

        $this->upcomingCourse = Course::create([
            'title' => 'Data Structures',
            'instructor' => 'Prof. Structures',
            'semester' => '3rd Semester',
            'description' => 'Advanced data structures.',
        ]);
    }

    public function test_student_dashboard_only_shows_current_semester_spotlight_courses(): void
    {
        $response = $this->actingAs($this->studentUser)->get('/student/dashboard');

        $response->assertStatus(200);
        $response->assertSee('OOP Java');
        $response->assertDontSee('Calculus I');
        $response->assertDontSee('Data Structures');
    }

    public function test_student_courses_page_only_shows_current_semester_courses(): void
    {
        $response = $this->actingAs($this->studentUser)->get('/student/courses');

        $response->assertStatus(200);
        $response->assertSee('OOP Java');
        $response->assertDontSee('Calculus I');
        $response->assertDontSee('Data Structures');
    }

    public function test_student_can_enroll_in_current_semester_course(): void
    {
        $response = $this->actingAs($this->studentUser)
            ->post(route('courses.enroll', $this->currentCourse));

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertTrue($this->studentUser->enrolledCourses()->where('course_id', $this->currentCourse->id)->exists());
    }

    public function test_student_can_enroll_in_previous_semester_course(): void
    {
        $response = $this->actingAs($this->studentUser)
            ->post(route('courses.enroll', $this->pastCourse));

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertTrue($this->studentUser->enrolledCourses()->where('course_id', $this->pastCourse->id)->exists());
    }

    public function test_student_cannot_enroll_in_upcoming_semester_course(): void
    {
        $response = $this->actingAs($this->studentUser)
            ->post(route('courses.enroll', $this->upcomingCourse));

        $response->assertRedirect();
        $response->assertSessionHas('error');
        $this->assertFalse($this->studentUser->enrolledCourses()->where('course_id', $this->upcomingCourse->id)->exists());
    }

    public function test_guest_cannot_enroll_in_any_course(): void
    {
        $response = $this->post(route('courses.enroll', $this->currentCourse));

        $response->assertRedirect('/login');
    }

    public function test_enrolled_previous_semester_courses_appear_in_student_courses_catalog_and_dashboard(): void
    {
        // First, check that student catalog doesn't show the past course
        $response1 = $this->actingAs($this->studentUser)->get('/student/courses');
        $response1->assertDontSee('Calculus I');

        // Enroll in previous semester course
        $this->studentUser->enrolledCourses()->attach($this->pastCourse->id);

        // Verify it now appears in student courses catalog
        $response2 = $this->actingAs($this->studentUser)->get('/student/courses');
        $response2->assertSee('Calculus I');

        // Verify it appears in student dashboard as well
        $response3 = $this->actingAs($this->studentUser)->get('/student/dashboard');
        $response3->assertSee('Calculus I');
    }
}
