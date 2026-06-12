@extends('layouts.public')

@section('styles')
<style>
    .courses-header {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.95), rgba(37, 99, 235, 0.9)), 
                    url('https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        color: #ffffff;
        padding: 80px 0;
        text-align: center;
    }
    .semester-title {
        position: relative;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 30px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e2e8f0;
    }
    .semester-title::after {
        content: "";
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 80px;
        height: 2px;
        background-color: #2563eb;
    }
    .course-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        background-color: #ffffff;
        transition: all 0.3s ease;
    }
    .course-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    }
    .course-img-wrapper {
        position: relative;
        height: 200px;
        overflow: hidden;
    }
    .course-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .course-card:hover .course-img {
        transform: scale(1.08);
    }
</style>
@endsection

@section('content')

<!-- Header Banner -->
<section class="courses-header">
    <div class="container py-3">
        <h1 class="display-4 fw-extrabold mb-3">Academic Syllabus & Courses</h1>
        <p class="lead opacity-90 mx-auto" style="max-width: 600px;">Explore courses organized by semester. Learn systematically throughout your academic journey.</p>
    </div>
</section>

<!-- Course List grouped by Semester -->
<section class="py-5 my-4">
    <div class="container">
        @forelse($groupedCourses as $semester => $courses)
            <div class="mb-5 pt-3">
                <h3 class="semester-title"><i class="fa-solid fa-graduation-cap text-primary me-2"></i>{{ $semester }}</h3>
                <div class="row g-4">
                    @foreach($courses as $course)
                        <div class="col-md-6 col-lg-4">
                            <div class="course-card h-100 d-flex flex-column justify-content-between">
                                <div>
                                    <div class="course-img-wrapper">
                                        <img src="{{ $course->image ?? 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=600&q=80' }}" class="course-img" alt="{{ $course->title }}">
                                    </div>
                                    <div class="p-4">
                                        <h5 class="fw-bold mb-2 text-dark">{{ $course->title }}</h5>
                                        <p class="text-secondary small card-text mb-0">{{ Str::limit($course->description, 130) }}</p>
                                    </div>
                                </div>
                                <div class="px-4 pb-4">
                                    <div class="border-top pt-3 d-flex justify-content-between text-secondary small align-items-center mb-3">
                                        <span><i class="fa-solid fa-user-tie text-primary me-1"></i> {{ $course->instructor }}</span>
                                        <span class="badge bg-primary-subtle text-primary">{{ $semester }}</span>
                                    </div>
                                    <a href="{{ route('courses.show', $course) }}" class="btn btn-primary w-100">See Course Syllabus</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 text-muted">
                <i class="fa-solid fa-graduation-cap display-1 mb-3 text-secondary opacity-50"></i>
                <h4>No courses found.</h4>
                <p>The academic curriculum has not been seeded yet. Please check back later.</p>
            </div>
        @endforelse
    </div>
</section>

@endsection
