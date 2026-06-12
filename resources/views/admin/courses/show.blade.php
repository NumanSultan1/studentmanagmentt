@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0 fw-bold"><i class="fa-solid fa-book-bookmark me-2 text-primary"></i>Course Details View</h5>
        <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary btn-action"><i class="fa-solid fa-arrow-left me-1"></i> Back to Catalog</a>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card card-custom text-center p-4">
                <img src="{{ !str_starts_with($course->image ?? '', 'http') && $course->image ? asset('storage/' . $course->image) : ($course->image ?? 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=600&q=80') }}" alt="{{ $course->title }}" class="img-fluid rounded-3 mb-3 border shadow-sm" style="max-height: 200px; object-fit: cover;">
                <h4 class="fw-bold text-dark">{{ $course->title }}</h4>
                <div class="badge bg-primary px-3 py-2 fs-7 my-2"><i class="fa-solid fa-calendar-days me-1"></i> {{ $course->semester }}</div>
                <hr>
                <div class="d-flex justify-content-around mt-3">
                    <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-sm btn-warning text-white px-3"><i class="fa-solid fa-pen-to-square me-1"></i> Edit Details</a>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card card-custom p-4 h-100">
                <h5 class="fw-bold text-dark mb-4 pb-2 border-bottom"><i class="fa-solid fa-circle-info me-2 text-primary"></i>Course Specifications</h5>
                
                <div class="row g-3 mb-4">
                    <div class="col-sm-6">
                        <span class="text-secondary small d-block">Course Title</span>
                        <strong class="text-dark">{{ $course->title }}</strong>
                    </div>
                    <div class="col-sm-6">
                        <span class="text-secondary small d-block">Instructor / Professor</span>
                        <strong class="text-dark">{{ $course->instructor }}</strong>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <span class="text-secondary small d-block">Academic Semester</span>
                        <strong class="text-dark">{{ $course->semester }}</strong>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <span class="text-secondary small d-block">Featured Status</span>
                        <strong class="text-dark">{{ $course->is_featured ? 'Featured on landing page' : 'Regular catalog course' }}</strong>
                    </div>
                </div>

                <h5 class="fw-bold text-dark mb-3 pt-3 border-top"><i class="fa-solid fa-list-check me-2 text-primary"></i>Syllabus Overview</h5>
                <p class="text-secondary mb-0" style="white-space: pre-line;">{{ $course->description }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
