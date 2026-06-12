@extends('layouts.student')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0 fw-bold"><i class="fa-solid fa-book-bookmark me-2 text-primary"></i>Course Details View</h5>
        <a href="{{ route('student.courses.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-arrow-left me-1"></i> Back to Catalog</a>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card card-custom text-center p-4">
                <img src="{{ !str_starts_with($course->image ?? '', 'http') && $course->image ? asset('storage/' . $course->image) : ($course->image ?? 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=600&q=80') }}" alt="{{ $course->title }}" class="img-fluid rounded-3 mb-3 border shadow-sm" style="max-height: 180px; object-fit: cover;">
                <h5 class="fw-bold text-dark">{{ $course->title }}</h5>
                <div class="badge bg-primary px-3 py-2 fs-7 my-2"><i class="fa-solid fa-calendar-days me-1"></i> {{ $course->semester }}</div>
                <hr>
                <div class="text-start mt-3 mb-4">
                    <p class="mb-2"><i class="fa-solid fa-chalkboard-user me-2 text-primary"></i> Instructor: <strong>{{ $course->instructor }}</strong></p>
                    <p class="mb-2"><i class="fa-solid fa-graduation-cap me-2 text-primary"></i> Core Syllabus: <strong>{{ $course->semester }}</strong></p>
                    <p class="mb-0"><i class="fa-solid fa-user-graduate me-2 text-primary"></i> My Semester: <strong>{{ $studentProfile->semester ?? '1st' }} Semester</strong></p>
                </div>
                <div class="border-top pt-3 text-center">
                    @if($isEnrolled)
                        <div class="btn btn-success w-100 disabled py-2"><i class="fa-solid fa-circle-check me-1"></i> Enrolled in Course</div>
                    @elseif($isUpcoming)
                        <div class="alert alert-warning small py-2 mb-0"><i class="fa-solid fa-lock me-1"></i> Locked - Upcoming Term</div>
                    @else
                        <form action="{{ route('courses.enroll', $course) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100 py-2"><i class="fa-solid fa-plus me-1"></i> Enroll in Course</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card card-custom p-4 h-100">
                <h5 class="fw-bold text-dark mb-4 pb-2 border-bottom"><i class="fa-solid fa-circle-info me-2 text-primary"></i>Course Syllabus</h5>
                <p class="text-secondary mb-0" style="white-space: pre-line;">{{ $course->description }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
