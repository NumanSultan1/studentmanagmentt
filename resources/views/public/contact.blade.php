@extends('layouts.public')

@section('styles')
<style>
    .contact-header {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.95), rgba(37, 99, 235, 0.9)), 
                    url('https://images.unsplash.com/photo-1423666639041-f56000c27a9a?auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        color: #ffffff;
        padding: 80px 0;
        text-align: center;
    }
    .contact-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        background-color: #ffffff;
        padding: 40px;
    }
    .form-control, .form-select {
        border-radius: 8px;
        padding: 12px;
        border: 1px solid #e2e8f0;
    }
    .form-control:focus, .form-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }
</style>
@endsection

@section('content')

<!-- Header Banner -->
<section class="contact-header">
    <div class="container py-3">
        <h1 class="display-4 fw-extrabold mb-3">Get in Touch</h1>
        <p class="lead opacity-90 mx-auto" style="max-width: 600px;">Have questions? Fill out the contact form below and our admissions team will write back shortly.</p>
    </div>
</section>

<!-- Contact Form and Details -->
<section class="py-5 my-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="contact-card">
                    <h3 class="fw-bold mb-4">Send a Message</h3>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm p-4 mb-4" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Full Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="John Doe" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Email Address</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="john@example.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold text-secondary">Subject</label>
                                <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}" placeholder="Inquiry about admissions, pricing, etc." required>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold text-secondary">Your Message</label>
                                <textarea name="message" rows="6" class="form-control @error('message') is-invalid @enderror" placeholder="Write details about your question..." required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary w-100 py-3"><i class="fa-solid fa-paper-plane me-2"></i>Send Secure Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="col-lg-5">
                <div class="contact-card bg-primary text-white h-100 d-flex flex-column justify-content-between">
                    <div>
                        <h3 class="fw-bold mb-4">Academic Headquarters</h3>
                        <p class="opacity-90 mb-5">Visit our administrative building for in-person advisory sessions, class enrollment support, or course information sheets.</p>
                        
                        <div class="d-flex gap-3 mb-4">
                            <div class="fs-4"><i class="fa-solid fa-location-dot"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Campus Location</h6>
                                <p class="opacity-90 mb-0">Comsats University Islamabad Wah Campus, G.T. Road, Wah Cantt, Pakistan</p>
                            </div>
                        </div>

                        <div class="d-flex gap-3 mb-4">
                            <div class="fs-4"><i class="fa-solid fa-phone"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Call Admissions</h6>
                                <p class="opacity-90 mb-0">+92 (51) 9049 5032</p>
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <div class="fs-4"><i class="fa-solid fa-envelope"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">Email Support</h6>
                                <p class="opacity-90 mb-0">info@eduportal.com</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-top border-white-50 pt-4 mt-5">
                        <h6 class="fw-bold mb-2">Office Hours</h6>
                        <p class="small mb-0 opacity-80">Monday – Friday: 9:00 AM – 5:00 PM (Pakistan Standard Time)<br>Saturday & Sunday: Closed</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
