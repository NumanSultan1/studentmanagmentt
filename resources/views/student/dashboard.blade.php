@extends('layouts.student')

@section('content')
<div class="container-fluid p-0">
    <div class="row g-4 mb-4 align-items-stretch">
        <!-- Welcoming Alert -->
        <div class="col-lg-6">
            <div class="card card-custom bg-primary text-white p-4 border-0 h-100 d-flex flex-column justify-content-center">
                <div>
                    <h3 class="fw-bold mb-2"><i class="fa-solid fa-user-graduate me-2 opacity-80"></i>Welcome Back, {{ $user->name }}!</h3>
                    <p class="opacity-90 mb-0 text-white-50">Manage your course catalog, review syllabus overview details, and update your personal portfolio profile card from this workspace portal.</p>
                </div>
            </div>
        </div>

        <!-- Student Profile Information Card -->
        <div class="col-lg-6">
            <div class="card card-custom p-4 h-100 d-flex flex-column justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=150&q=80' }}" alt="{{ $user->name }}" class="rounded-circle border border-3 border-primary shadow-sm" style="width: 70px; height: 70px; object-fit: cover;">
                    <div>
                        <h4 class="fw-bold text-dark mb-1">{{ $user->name }}</h4>
                        <span class="badge bg-primary px-2 py-1 fs-8 me-1">{{ $studentProfile->department ?? 'CS Freshman' }}</span>
                        <span class="badge bg-secondary px-2 py-1 fs-8">{{ $studentProfile->semester ?? '1st' }} Semester</span>
                    </div>
                </div>
                <div class="row mt-3 g-2 text-start">
                    <div class="col-sm-6 text-truncate small text-secondary">
                        <i class="fa-solid fa-envelope me-1 text-primary"></i> {{ $user->email }}
                    </div>
                    <div class="col-sm-6 text-truncate small text-secondary">
                        <i class="fa-solid fa-phone me-1 text-primary"></i> {{ $user->phone ?? 'No phone' }}
                    </div>
                </div>
                <div class="mt-3 text-end">
                    <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-primary px-3 py-1"><i class="fa-solid fa-user-pen me-1"></i> Edit Profile</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Stats and Course Tiles -->
        <div class="col-12">
            <!-- Academy Catalog Metrics -->
            <div class="card card-custom p-4 mb-4">
                <h5 class="fw-bold text-dark mb-4"><i class="fa-solid fa-chart-simple text-primary me-2"></i>Academy Catalog Metrics</h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-light-subtle text-center">
                            <h3 class="fw-bold text-primary mb-1">{{ $stats['total_courses'] }}</h3>
                            <span class="text-secondary small d-block">Semester Courses Available</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-light-subtle text-center">
                            <h3 class="fw-bold text-success mb-1">{{ $stats['my_enrolled_courses'] }}</h3>
                            <span class="text-secondary small d-block">My Enrolled Courses</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-light-subtle text-center">
                            <h3 class="fw-bold text-warning mb-1">{{ $stats['my_reviews'] }}</h3>
                            <span class="text-secondary small d-block">Reviews Sent</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Tiles/Grid -->
            <div class="card card-custom p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold text-dark mb-0"><i class="fa-solid fa-graduation-cap text-primary me-2"></i>My Semester Courses</h5>
                    <span class="badge bg-secondary px-3 py-2">Catalog for {{ $studentProfile->semester ?? '1st' }} Semester</span>
                </div>

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @forelse($recentCourses as $course)
                        <div class="col">
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
                                        <p class="text-secondary small mb-0">{{ Str::limit($course->description, 100) }}</p>
                                    </div>
                                </div>
                                <div class="p-3 border-top bg-light-subtle d-flex flex-column gap-2">
                                    <div class="d-flex justify-content-between text-secondary small align-items-center mb-1">
                                        <span><i class="fa-solid fa-user-tie me-1"></i> {{ $course->instructor }}</span>
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
                                    <a href="{{ route('student.courses.show', $course) }}" class="text-center small text-primary text-decoration-none mt-1">View Syllabus Details</a>
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
                        <div class="col-12 text-center py-4 text-muted">
                            <i class="fa-solid fa-graduation-cap display-4 mb-2 opacity-50"></i>
                            <p class="mb-0">No courses available for your semester term.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
