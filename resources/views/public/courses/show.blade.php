@extends('layouts.public')

@section('styles')
<style>
    .course-details-header {
        background-color: #0f172a;
        color: #ffffff;
        padding: 60px 0;
    }
    .detail-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        background-color: #ffffff;
    }
</style>
@endsection

@section('content')

<!-- Header Banner -->
<section class="course-details-header">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3">
                        <li class="breadcrumb-item"><a href="{{ route('courses') }}" class="text-primary text-decoration-none">Courses</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Details</li>
                    </ol>
                </nav>
                <h1 class="display-4 fw-extrabold mb-3">{{ $course->title }}</h1>
                <p class="lead text-light opacity-95 mb-4">{{ Str::limit($course->description, 180) }}</p>
                <div class="d-flex flex-wrap gap-4 text-light opacity-90">
                    <span><i class="fa-solid fa-user-tie me-2 text-primary"></i> Instructor: <strong>{{ $course->instructor }}</strong></span>
                    <span><i class="fa-solid fa-calendar-days me-2 text-primary"></i> Semester Term: <strong>{{ $course->semester }}</strong></span>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end">
                <div class="bg-light-subtle p-4 rounded-4 border border-light-subtle d-inline-block text-start" style="width: 100%; max-width: 320px; backdrop-filter: blur(5px);">
                    <span class="text-secondary small">Academic Status</span>
                    <h4 class="fw-extrabold text-primary my-2"><i class="fa-solid fa-circle-check text-success me-1"></i> Active Curriculum</h4>
                    @auth
                        @if(auth()->user()->isStudent())
                            @if($isEnrolled)
                                <div class="btn btn-success w-100 py-3 mt-3 disabled"><i class="fa-solid fa-circle-check me-1"></i> Already Enrolled</div>
                            @elseif($isUpcoming)
                                <div class="btn btn-warning text-white w-100 py-3 mt-3 disabled"><i class="fa-solid fa-lock me-1"></i> Locked (Upcoming Term)</div>
                            @else
                                <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary w-100 py-3 mt-3"><i class="fa-solid fa-plus me-1"></i> Enroll in Course</button>
                                </form>
                            @endif
                            <a href="{{ route('student.dashboard') }}" class="btn btn-outline-light w-100 py-2 mt-2 text-center text-decoration-none btn-sm">Go to Student Portal</a>
                        @else
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary w-100 py-3 mt-3">Go to Admin Dashboard</a>
                        @endif
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary w-100 py-3 mt-3">Register Student Account</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Detailed Description -->
<section class="py-5 my-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="detail-card p-5 mb-4">
                    <h3 class="fw-bold mb-4">Course Description</h3>
                    <p class="text-secondary mb-4">{{ $course->description }}</p>
                    <p class="text-secondary mb-4">This course forms an essential part of the degree requirement for this semester. It includes classroom lectures, lab hours, weekly assignments, and term exams.</p>
                    
                    <h4 class="fw-bold mt-5 mb-3">Academic Guidelines</h4>
                    <div class="row g-3">
                        <div class="col-md-6 text-secondary"><i class="fa-solid fa-circle-check text-primary me-2"></i> Attendance threshold: 75% minimum.</div>
                        <div class="col-md-6 text-secondary"><i class="fa-solid fa-circle-check text-primary me-2"></i> Assignment deadlines are strictly enforced.</div>
                        <div class="col-md-6 text-secondary"><i class="fa-solid fa-circle-check text-primary me-2"></i> Standard mid-term & final examinations.</div>
                        <div class="col-md-6 text-secondary"><i class="fa-solid fa-circle-check text-primary me-2"></i> Grading scale is based on credit points.</div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="detail-card p-4 text-center">
                    <img src="{{ $course->image ?? 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=600&q=80' }}" class="img-fluid rounded-3 shadow-sm" alt="{{ $course->title }}">
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
