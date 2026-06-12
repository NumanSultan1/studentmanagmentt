<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EduPortal - Smart Academy</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }
        .navbar {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }
        .navbar-brand {
            font-weight: 800;
            color: #2563eb !important;
            letter-spacing: -0.5px;
        }
        .nav-link {
            font-weight: 500;
            color: #475569 !important;
            transition: color 0.2s ease;
        }
        .nav-link:hover, .nav-link.active {
            color: #2563eb !important;
        }
        .btn-primary {
            background-color: #2563eb;
            border-color: #2563eb;
            border-radius: 8px;
            font-weight: 600;
            padding: 8px 20px;
            transition: all 0.2s ease;
        }
        .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
            transform: translateY(-1px);
        }
        .footer {
            background-color: #0f172a;
            color: #94a3b8;
            padding: 60px 0 30px;
        }
        .footer h5 {
            color: #ffffff;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .footer-links a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .footer-links a:hover {
            color: #3b82f6;
        }
        .social-btn {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.08);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            margin-right: 10px;
            transition: all 0.2s ease;
        }
        .social-btn:hover {
            background-color: #2563eb;
            color: #ffffff;
            transform: scale(1.1);
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Header / Sticky Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top py-3">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fa-solid fa-graduation-cap me-2"></i>EDUPORTAL
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('courses*') ? 'active' : '' }}" href="{{ route('courses') }}">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('testimonials') ? 'active' : '' }}" href="{{ route('testimonials') }}">Testimonials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact Us</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">
                            <i class="fa-solid fa-user-shield me-2"></i>Portal
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline m-0">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary border-0">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary border-0 px-3">Log In</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-vh-100">
        @if(session('success'))
            <div class="container mt-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container mt-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-exclamation me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if(session('warning'))
            <div class="container mt-3">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i>{{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-lg-4">
                    <h5 class="navbar-brand text-white fs-4"><i class="fa-solid fa-graduation-cap me-2"></i>EDUPORTAL</h5>
                    <p class="mt-3">A modern educational hub offering world-class learning experiences. Empowering students with cutting edge technology and master instructors.</p>
                    <div class="mt-4">
                        <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-btn"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-btn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-btn"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-md-4 col-lg-2 offset-lg-2 footer-links">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled d-flex flex-column gap-2">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('courses') }}">Courses</a></li>
                        <li><a href="{{ route('gallery') }}">Gallery</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-lg-2 footer-links">
                    <h5>Support</h5>
                    <ul class="list-unstyled d-flex flex-column gap-2">
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                        <li><a href="{{ route('testimonials') }}">Testimonials</a></li>
                        <li><a href="{{ route('login') }}">Member Login</a></li>
                        <li><a href="{{ route('register') }}">Join Academy</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-lg-2">
                    <h5>Contact Info</h5>
                    <ul class="list-unstyled text-light d-flex flex-column gap-2">
                        <li><i class="fa-solid fa-location-dot me-2 text-primary"></i> COMSATS University Wah Campus</li>
                        <li><i class="fa-solid fa-phone me-2 text-primary"></i> +92 (51) 9049 5032</li>
                        <li><i class="fa-solid fa-envelope me-2 text-primary"></i> info@eduportal.com</li>
                    </ul>
                </div>
            </div>
            <hr class="border-secondary">
            <div class="row pt-3">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; {{ date('Y') }} EduPortal. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                    <a href="#" class="text-secondary text-decoration-none me-3">Privacy Policy</a>
                    <a href="#" class="text-secondary text-decoration-none">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
