@extends('layouts.student')

@section('content')
<div class="card card-custom">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0"><i class="fa-solid fa-graduation-cap me-2 text-primary"></i>My Semester Course Catalog</h5>
            <span class="badge bg-primary px-3 py-2">{{ $semesterName }}</span>
        </div>

        <div class="row g-4">
            @forelse($courses as $course)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border rounded-3 overflow-hidden shadow-sm d-flex flex-column justify-content-between">
                        <div>
                            <div class="position-relative">
                                <img src="{{ !str_starts_with($course->image ?? '', 'http') && $course->image ? asset('storage/' . $course->image) : ($course->image ?? 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=600&q=80') }}" class="card-img-top" alt="{{ $course->title }}" style="height: 150px; object-fit: cover;">
                                @if(in_array($course->id, $enrolledCourseIds))
                                    <span class="position-absolute top-0 end-0 m-2 badge bg-success"><i class="fa-solid fa-circle-check"></i> Enrolled</span>
                                @endif
                            </div>
                            <div class="p-3">
                                <h6 class="fw-bold text-dark mb-1">{{ $course->title }}</h6>
                                <p class="text-secondary small card-text mb-0">{{ Str::limit($course->description, 90) }}</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 pt-2">
                            <div class="d-flex justify-content-between text-secondary small align-items-center mb-3">
                                <span><i class="fa-solid fa-user-tie me-1"></i> {{ $course->instructor }}</span>
                                <span class="badge bg-primary-subtle text-primary">{{ $course->semester }}</span>
                            </div>
                            @if(in_array($course->id, $enrolledCourseIds))
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-success flex-grow-1 disabled py-2"><i class="fa-solid fa-circle-check me-1"></i> Enrolled</button>
                                    <button type="button" class="btn btn-sm btn-warning text-white py-2" data-bs-toggle="modal" data-bs-target="#reviewModal{{ $course->id }}" title="Review Course"><i class="fa-solid fa-star"></i> Review</button>
                                </div>
                            @else
                                <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary w-100 py-2"><i class="fa-solid fa-plus me-1"></i> Enroll / Register</button>
                                </form>
                            @endif
                            <a href="{{ route('student.courses.show', $course) }}" class="text-center small text-primary text-decoration-none mt-1 d-block">View Syllabus Details</a>
                        </div>
                    </div>
                </div>

                <!-- Modal for course review -->
                <div class="modal fade" id="reviewModal{{ $course->id }}" tabindex="-1" aria-labelledby="reviewModalLabel{{ $course->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold" id="reviewModalLabel{{ $course->id }}"><i class="fa-solid fa-star text-warning me-2"></i>Review Course: {{ $course->title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('student.testimonials.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="course" value="{{ $course->title }}">
                                <div class="modal-body text-start">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold text-secondary">Course Rating (1 to 5 Stars)</label>
                                        <select name="rating" class="form-select" required>
                                            <option value="5">★★★★★ - Excellent (5 Stars)</option>
                                            <option value="4">★★★★☆ - Very Good (4 Stars)</option>
                                            <option value="3">★★★☆☆ - Good (3 Stars)</option>
                                            <option value="2">★★☆☆☆ - Fair (2 Stars)</option>
                                            <option value="1">★☆☆☆☆ - Poor (1 Star)</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold text-secondary">Your Testimonial Review</label>
                                        <textarea name="content" rows="4" class="form-control" placeholder="Share your learning experience, what you liked about the professor or course materials..." required minlength="10" maxlength="1000"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane me-1"></i> Submit Review</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    <i class="fa-solid fa-graduation-cap display-1 mb-3 text-secondary opacity-50"></i>
                    <h5>No courses available for your semester.</h5>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
