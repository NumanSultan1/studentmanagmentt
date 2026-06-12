@extends('layouts.student')

@section('content')
<div class="card card-custom">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-4"><i class="fa-solid fa-quote-left me-2 text-primary"></i>My Feedback & Reviews</h5>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm p-3 mb-4" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">
            <!-- Submit new review -->
            <div class="col-lg-5">
                <div class="p-4 border rounded-3 bg-light-subtle">
                    <h6 class="fw-bold mb-3">Submit Review Testimonial</h6>
                    <form action="{{ route('student.testimonials.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary">Course Title (Optional)</label>
                            <input type="text" name="course" class="form-control" placeholder="Laravel Web Dev, etc.">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary">Rating</label>
                            <select name="rating" class="form-select" required>
                                <option value="5">⭐⭐⭐⭐⭐ (5 Star)</option>
                                <option value="4">⭐⭐⭐⭐ (4 Star)</option>
                                <option value="3">⭐⭐⭐ (3 Star)</option>
                                <option value="2">⭐⭐ (2 Star)</option>
                                <option value="1">⭐ (1 Star)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary">Review Message</label>
                            <textarea name="content" rows="4" class="form-control @error('content') is-invalid @enderror" placeholder="Write your review here..." required></textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2"><i class="fa-solid fa-check me-1"></i> Submit feedback</button>
                    </form>
                </div>
            </div>

            <!-- Existing reviews -->
            <div class="col-lg-7">
                <h6 class="fw-bold mb-3">My Reviews History</h6>
                <div class="d-flex flex-column gap-3">
                    @forelse($myTestimonials as $review)
                        <div class="p-3 border rounded-3 bg-white shadow-sm">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold text-dark small">{{ $review->course ?? 'General Feedback' }}</span>
                                <span class="text-warning small">
                                    @for($i = 0; $i < $review->rating; $i++)
                                        <i class="fa-solid fa-star"></i>
                                    @endfor
                                    @for($i = $review->rating; $i < 5; $i++)
                                        <i class="fa-regular fa-star"></i>
                                    @endfor
                                </span>
                            </div>
                            <p class="text-secondary small mb-2">"{{ $review->content }}"</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">Submitted on {{ $review->created_at->format('M d, Y') }}</small>
                                @if($review->is_featured)
                                    <span class="badge bg-success-subtle text-success small">Featured on Home</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary small">Pending Spotlight Approval</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center py-4">You have not submitted any reviews yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
