@extends('layouts.public')

@section('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.95), rgba(37, 99, 235, 0.9)), 
                    url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        color: #ffffff;
        padding: 140px 0 160px;
        position: relative;
        overflow: hidden;
    }
    .hero-section::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 60px;
        background: #f8fafc;
        clip-path: polygon(0 100%, 100% 0, 100% 100%);
    }
    .stat-card {
        border: none;
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        transition: transform 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
    .course-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        background-color: #ffffff;
    }
    .course-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
    .course-img-wrapper {
        position: relative;
        height: 220px;
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
    .course-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: rgba(37, 99, 235, 0.9);
        color: #ffffff;
        font-weight: 700;
        font-size: 0.8rem;
        padding: 5px 12px;
        border-radius: 30px;
        backdrop-filter: blur(5px);
    }
    .testimonial-card {
        border: none;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
    }
    .feature-icon-box {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        background-color: rgba(37, 99, 235, 0.1);
        color: #2563eb;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 20px;
    }
    .cta-section {
        background: linear-gradient(135deg, #1e3a8a, #2563eb);
        color: #ffffff;
        border-radius: 24px;
        padding: 80px 40px;
        position: relative;
        overflow: hidden;
    }
    .cta-bubble {
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }
    .bubble-1 { top: -100px; right: -100px; }
    .bubble-2 { bottom: -150px; left: -100px; }
</style>
@endsection

@section('content')

<!-- Hero Section -->
<section class="hero-section d-flex align-items-center">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill mb-3 fw-semibold">
                    <i class="fa-solid fa-sparkles me-2"></i>Empowering Future Tech Leaders
                </span>
                <h1 class="display-3 fw-extrabold mb-4 lh-sm">Smart Education For A Smarter World</h1>
                <p class="lead mb-5 opacity-90">Unlock your potential with our master-led IT courses, interactive computer labs, and globally recognized certifications. Start your journey today.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('courses') }}" class="btn btn-primary btn-lg px-4 py-3"><i class="fa-solid fa-graduation-cap me-2"></i>Explore Courses</a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg px-4 py-3"><i class="fa-solid fa-paper-plane me-2"></i>Get Free Advice</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-end d-none d-lg-block">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=600&q=80" alt="Students Studying" class="img-fluid rounded-4 shadow-lg border border-light border-5">
            </div>
        </div>
    </div>
</section>

<!-- Statistics counters -->
<section class="py-5" style="margin-top:-60px; z-index:10; position:relative;">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-6 col-md-3">
                <div class="stat-card p-4">
                    <h2 class="display-5 fw-bold text-primary mb-1">{{ $stats['students'] }}+</h2>
                    <span class="text-secondary fw-medium">Active Students</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card p-4">
                    <h2 class="display-5 fw-bold text-primary mb-1">{{ $stats['courses'] }}</h2>
                    <span class="text-secondary fw-medium">Professional Courses</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card p-4">
                    <h2 class="display-5 fw-bold text-primary mb-1">{{ $stats['instructors'] }}</h2>
                    <span class="text-secondary fw-medium">Master Instructors</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card p-4">
                    <h2 class="display-5 fw-bold text-primary mb-1">{{ $stats['satisfaction'] }}</h2>
                    <span class="text-secondary fw-medium">Satisfaction Rate</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-5 my-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1531545514256-b1400bc00f31?auto=format&fit=crop&w=600&q=80" alt="Why Choose Us" class="img-fluid rounded-4 shadow-sm">
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold display-5 mb-4">Why Smart Minds Choose EduPortal?</h2>
                <p class="text-secondary mb-5">We go beyond textbook lessons, offering practical, project-based engineering models that prepare you directly for the industry.</p>
                
                <div class="d-flex gap-4 mb-4">
                    <div class="feature-icon-box flex-shrink-0">
                        <i class="fa-solid fa-microchip"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-2">Modern State-of-the-Art Labs</h5>
                        <p class="text-secondary mb-0">High-performance workstations, real networking labs, and high-speed campus fiber connectivity.</p>
                    </div>
                </div>

                <div class="d-flex gap-4 mb-4">
                    <div class="feature-icon-box flex-shrink-0">
                        <i class="fa-solid fa-users-gear"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-2">Expert Team Mentoring</h5>
                        <p class="text-secondary mb-0">Learn from seasoned developers and engineers with extensive experience in global IT firms.</p>
                    </div>
                </div>

                <div class="d-flex gap-4">
                    <div class="feature-icon-box flex-shrink-0">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-2">100% Career Placement Support</h5>
                        <p class="text-secondary mb-0">Regular job fairs, interview coaching sessions, and direct resume sharing with top IT recruiter firms.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Courses -->
<section class="py-5 bg-light-subtle">
    <div class="container py-3">
        <div class="d-flex flex-wrap justify-content-between align-items-end mb-5">
            <div>
                <span class="text-primary fw-bold text-uppercase tracking-wider">Top Programs</span>
                <h2 class="display-5 fw-bold mt-2">Explore Featured Courses</h2>
            </div>
            <a href="{{ route('courses') }}" class="btn btn-outline-primary px-4 py-2 mt-3 mt-sm-0">View All Courses <i class="fa-solid fa-arrow-right ms-2"></i></a>
        </div>
        
        <div class="row g-4">
            @forelse($featuredCourses as $course)
                <div class="col-md-6 col-lg-4">
                    <div class="course-card h-100">
                        <div class="course-img-wrapper">
                            <img src="{{ $course->image ?? 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=600&q=80' }}" class="course-img" alt="{{ $course->title }}">
                            <span class="course-badge">{{ $course->semester }}</span>
                        </div>
                        <div class="course-card-body p-4 d-flex flex-column h-100">
                            <h5 class="card-title fw-bold mb-2">{{ $course->title }}</h5>
                            <p class="text-secondary flex-grow-1 card-text small mb-4">{{ Str::limit($course->description, 120) }}</p>
                            <div class="border-top pt-3 d-flex justify-content-between text-secondary small align-items-center">
                                <span><i class="fa-solid fa-chalkboard-user me-1 text-primary"></i> {{ $course->instructor }}</span>
                                <span class="badge bg-primary-subtle text-primary">{{ $course->semester }}</span>
                            </div>
                            <a href="{{ route('courses.show', $course) }}" class="btn btn-primary mt-4 w-100">See Detailed Course</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">No featured courses available yet.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5 my-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="text-primary fw-bold text-uppercase">Reviews</span>
            <h2 class="display-5 fw-bold mt-2">Hear From Our Successful Alumni</h2>
        </div>

        <div class="row g-4">
            @forelse($testimonials as $testimonial)
                <div class="col-md-4">
                    <div class="testimonial-card p-5 h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="text-warning mb-3">
                                @for($i = 0; $i < $testimonial->rating; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                                @for($i = $testimonial->rating; $i < 5; $i++)
                                    <i class="fa-regular fa-star"></i>
                                @endfor
                            </div>
                            <p class="text-secondary italic mb-4">"{{ $testimonial->content }}"</p>
                        </div>
                        <div class="d-flex align-items-center mt-3 pt-3 border-top">
                            <img src="{{ $testimonial->student_image ?? 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=150&q=80' }}" alt="{{ $testimonial->student_name }}" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                            <div>
                                <h6 class="fw-bold mb-0">{{ $testimonial->student_name }}</h6>
                                <small class="text-muted">{{ $testimonial->course ?? 'Alumni' }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">No testimonials seeded yet.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="container py-5 my-5">
    <div class="cta-section text-center">
        <div class="cta-bubble bubble-1"></div>
        <div class="cta-bubble bubble-2"></div>
        <div style="position:relative; z-index:5;">
            <h2 class="display-4 fw-extrabold mb-3">Ready to Jumpstart Your Career?</h2>
            <p class="lead mb-5 opacity-90 mx-auto" style="max-width: 600px;">Join thousands of students learning modern software methodologies, system design, databases, and responsive frameworks.</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4 py-3 fw-bold text-primary">Apply Online Now</a>
                <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg px-4 py-3">Talk to Admissions</a>
            </div>
        </div>
    </div>
</section>

@endsection
