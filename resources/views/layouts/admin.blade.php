<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - EduPortal</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f1f5f9;
        }
        .wrapper {
            display: flex;
            align-items: stretch;
            min-height: 100vh;
        }
        #sidebar {
            min-width: 260px;
            max-width: 260px;
            background-color: #0f172a;
            color: #94a3b8;
            transition: all 0.3s;
        }
        #sidebar.active {
            margin-left: -260px;
        }
        #sidebar .sidebar-header {
            padding: 24px;
            background-color: #1e293b;
            color: #ffffff;
            font-weight: 800;
        }
        #sidebar ul.components {
            padding: 20px 0;
        }
        #sidebar ul li {
            padding: 5px 15px;
        }
        #sidebar ul li a {
            padding: 12px 15px;
            font-size: 0.95rem;
            font-weight: 500;
            display: block;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        #sidebar ul li a:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.05);
        }
        #sidebar ul li.active > a {
            color: #ffffff;
            background-color: #2563eb;
        }
        #sidebar ul li a i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }
        #content {
            width: 100%;
            padding: 30px;
            min-height: 100vh;
            transition: all 0.3s;
        }
        .admin-navbar {
            background-color: #ffffff;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.02);
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 30px;
            border: 1px solid #e2e8f0;
        }
        .card-custom {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
        }
        .btn-action {
            border-radius: 8px;
            font-weight: 600;
            padding: 8px 16px;
        }
    </style>
    @yield('styles')
</head>
<body>

    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header d-flex align-items-center justify-content-between">
                <span class="fs-5 tracking-wider"><i class="fa-solid fa-graduation-cap me-2 text-primary"></i>EDUPORTAL</span>
                <span class="badge bg-danger text-uppercase px-2 py-1 small">Admin</span>
            </div>

            <ul class="list-unstyled components">
                <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
                </li>
                <li class="{{ Route::is('admin.students*') ? 'active' : '' }}">
                    <a href="{{ route('admin.students.index') }}"><i class="fa-solid fa-users"></i> Students</a>
                </li>
                <li class="{{ Route::is('admin.courses*') ? 'active' : '' }}">
                    <a href="{{ route('admin.courses.index') }}"><i class="fa-solid fa-book-open"></i> Courses</a>
                </li>
                <li class="{{ Route::is('admin.gallery*') ? 'active' : '' }}">
                    <a href="{{ route('admin.gallery.index') }}"><i class="fa-solid fa-images"></i> Gallery</a>
                </li>
                <li class="{{ Route::is('admin.testimonials*') ? 'active' : '' }}">
                    <a href="{{ route('admin.testimonials.index') }}"><i class="fa-solid fa-quote-left"></i> Testimonials</a>
                </li>
                <li class="{{ Route::is('admin.messages*') ? 'active' : '' }}">
                    <a href="{{ route('admin.messages.index') }}"><i class="fa-solid fa-envelope-open-text"></i> Messages</a>
                </li>
                <li class="{{ Route::is('profile.edit') ? 'active' : '' }}">
                    <a href="{{ route('profile.edit') }}"><i class="fa-solid fa-user-gear"></i> Profile</a>
                </li>
                <li>
                    <a href="{{ route('home') }}"><i class="fa-solid fa-house-laptop"></i> Public Website</a>
                </li>
                <li class="mt-4">
                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-danger">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </a>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg admin-navbar d-flex justify-content-between align-items-center">
                <button type="button" id="sidebarCollapse" class="btn btn-outline-secondary border-0">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="d-flex align-items-center gap-3">
                    <span class="text-secondary small fw-medium">Welcome back,</span>
                    <span class="fw-bold">{{ auth()->user()->name }}</span>
                    <img src="{{ auth()->user()->profile_photo_path ? asset('storage/' . auth()->user()->profile_photo_path) : 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=150&q=80' }}" alt="Profile Avatar" class="rounded-circle border" style="width: 38px; height: 38px; object-fit: cover;">
                </div>
            </nav>

            <!-- Main Render Space -->
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarCollapse').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
    @yield('scripts')
</body>
</html>
