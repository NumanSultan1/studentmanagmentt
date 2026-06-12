@extends('layouts.public')

@section('styles')
<style>
    .about-header {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.95), rgba(37, 99, 235, 0.9)), 
                    url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        color: #ffffff;
        padding: 80px 0;
        text-align: center;
    }
    .value-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        background-color: #ffffff;
        padding: 40px 30px;
        height: 100%;
        transition: transform 0.3s ease;
    }
    .value-card:hover {
        transform: translateY(-5px);
    }
    .value-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: rgba(37, 99, 235, 0.1);
        color: #2563eb;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 20px;
    }
    .team-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        background-color: #ffffff;
        transition: all 0.3s ease;
    }
    .team-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
    }
    .team-img-wrapper {
        height: 300px;
        overflow: hidden;
    }
    .team-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
@endsection

@section('content')

<!-- Header Banner -->
<section class="about-header">
    <div class="container py-3">
        <h1 class="display-4 fw-extrabold mb-3">About Our Academy</h1>
        <p class="lead opacity-90 mx-auto" style="max-width: 600px;">Transforming ambitious minds into skilled industry practitioners through hands-on technology education.</p>
    </div>
</section>

<!-- Our Story Section -->
<section class="py-5 my-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="text-primary fw-bold text-uppercase">Our Heritage</span>
                <h2 class="display-5 fw-bold mt-2 mb-4">Empowering Innovation Since 2018</h2>
                <p class="text-secondary mb-4">EduPortal was founded with a single mission: to bridge the gap between academic theory and practical software engineering. Recognizing that the modern tech workspace updates faster than college textbooks, we created a dynamic training ecosystem built on agile, project-first principles.</p>
                <p class="text-secondary mb-4">Today, we host thousands of graduates globally who work as network architects, software engineers, and product designers at top-tier firms. We continue to innovate by updating our courses weekly to align with the latest programming languages and infrastructure platforms.</p>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=600&q=80" alt="Our Story Image" class="img-fluid rounded-4 shadow-sm">
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision Cards -->
<section class="py-5 bg-light-subtle">
    <div class="container py-3">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="value-card">
                    <div class="value-icon"><i class="fa-solid fa-bullseye"></i></div>
                    <h4 class="fw-bold mb-3">Our Dedicated Mission</h4>
                    <p class="text-secondary mb-0">To provide high-quality, modern, and affordable technology education that equips students with real-world skills, enabling them to secure competitive careers and thrive in a digital-first economy.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="value-card">
                    <div class="value-icon"><i class="fa-solid fa-eye"></i></div>
                    <h4 class="fw-bold mb-3">Our Futuristic Vision</h4>
                    <p class="text-secondary mb-0">To be a globally recognized leader in agile educational models, shaping the future of technical tutoring through immersive hands-on projects, digital labs, and direct industry collaboration.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Members -->
<section class="py-5 my-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="text-primary fw-bold text-uppercase">Academic Leaders</span>
            <h2 class="display-5 fw-bold mt-2">Meet Our Advisory Team</h2>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($team as $member)
                <div class="col-md-6 col-lg-4">
                    <div class="team-card h-100">
                        <div class="team-img-wrapper">
                            <img src="{{ $member['image'] }}" class="team-img" alt="{{ $member['name'] }}">
                        </div>
                        <div class="p-4">
                            <h5 class="fw-bold mb-1">{{ $member['name'] }}</h5>
                            <span class="text-primary d-block small mb-3 fw-medium">{{ $member['role'] }}</span>
                            <p class="text-secondary small mb-0">{{ $member['bio'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
