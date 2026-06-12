@extends('layouts.public')

@section('styles')
<style>
    .testimonials-header {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.95), rgba(37, 99, 235, 0.9)), 
                    url('https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        color: #ffffff;
        padding: 80px 0;
        text-align: center;
    }
    .testimonial-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        background-color: #ffffff;
        padding: 40px;
        height: 100%;
        transition: transform 0.3s ease;
    }
    .testimonial-card:hover {
        transform: translateY(-5px);
    }
    .form-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        background-color: #ffffff;
        padding: 40px;
    }
</style>
@endsection

@section('content')

<!-- Header Banner -->
<section class="testimonials-header">
    <div class="container py-3">
        <h1 class="display-4 fw-extrabold mb-3">Student Reviews</h1>
        <p class="lead opacity-90 mx-auto" style="max-width: 600px;">Read honest feedback from alumni. Join them by writing your review if you are a registered student.</p>
    </div>
</section>

<!-- Feedback Grid -->
<section class="py-5 my-5">
    <div class="container">
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm p-4 mb-5" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4 mb-5">
            @forelse($testimonials as $testimonial)
                <div class="col-md-6">
                    <div class="testimonial-card d-flex flex-column justify-content-between">
                        <div>
                            <div class="text-warning mb-3">
                                @for($i = 0; $i < $testimonial->rating; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                                @for($i = $testimonial->rating; $i < 5; $i++)
                                    <i class="fa-regular fa-star"></i>
                                @endfor
                            </div>
                            <p class="text-secondary italic mb-4 fs-5">"{{ $testimonial->content }}"</p>
                        </div>
                        <div class="d-flex align-items-center mt-4 pt-3 border-top">
                            <img src="{{ !str_starts_with($testimonial->student_image ?? '', 'http') && $testimonial->student_image ? asset('storage/' . $testimonial->student_image) : ($testimonial->student_image ?? 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=150&q=80') }}" alt="{{ $testimonial->student_name }}" class="rounded-circle me-3" style="width: 55px; height: 55px; object-fit: cover;">
                            <div>
                                <h6 class="fw-bold mb-0 text-dark">{{ $testimonial->student_name }}</h6>
                                <small class="text-muted">{{ $testimonial->course ?? 'Alumni Cohort' }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">No reviews yet. Be the first to add one!</div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mb-5">
            {{ $testimonials->links() }}
        </div>

        <!-- Add testimonial form -->
        <div class="row justify-content-center mt-5 pt-4">
            <div class="col-lg-8">
                <div class="form-card">
                    <h3 class="fw-bold text-center mb-4">Write a Testimonial</h3>
                    @auth
                        @if(auth()->user()->isStudent())
                            <form action="{{ route('testimonials.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary">Course Name (Optional)</label>
                                        <input type="text" name="course" class="form-control" placeholder="Full-Stack Web Dev, etc.">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary">Rating Score</label>
                                        <select name="rating" class="form-select" required>
                                            <option value="5">⭐⭐⭐⭐⭐ (5 Star - Excellent)</option>
                                            <option value="4">⭐⭐⭐⭐ (4 Star - Very Good)</option>
                                            <option value="3">⭐⭐⭐ (3 Star - Average)</option>
                                            <option value="2">⭐⭐ (2 Star - Below Average)</option>
                                            <option value="1">⭐ (1 Star - Poor)</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold text-secondary">Your Feedback</label>
                                        <textarea name="content" rows="5" class="form-control @error('content') is-invalid @enderror" placeholder="Write about your learning experience..." required></textarea>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mt-4 text-center">
                                        <button type="submit" class="btn btn-primary px-5 py-3"><i class="fa-solid fa-check-double me-2"></i>Submit Testimonial</button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <div class="alert alert-warning border-0 rounded-3 p-4 mb-0 text-center">
                                <i class="fa-solid fa-triangle-exclamation me-2"></i> Admins cannot submit student reviews. Please register or log in as a student account to review a course.
                            </div>
                        @endif
                    @else
                        <div class="alert alert-secondary border-0 rounded-3 p-4 mb-0 text-center">
                            <i class="fa-solid fa-lock me-2"></i> Only authenticated student members can write reviews. 
                            <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none ms-1">Log In Here</a> 
                            or <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Create Account</a>.
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
