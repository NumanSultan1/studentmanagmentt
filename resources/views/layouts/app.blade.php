<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #1e3a5f 0%, #2563eb 100%);
            width: 240px;
            position: fixed;
            top: 0; left: 0;
            padding-top: 20px;
            z-index: 100;
        }
        .sidebar .brand { color: #fff; font-size: 1.2rem; font-weight: 700; padding: 16px 20px 24px; border-bottom: 1px solid rgba(255,255,255,0.15); }
        .sidebar .nav-link { color: rgba(255,255,255,0.8); padding: 10px 20px; border-radius: 8px; margin: 2px 10px; transition: all .2s; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: rgba(255,255,255,0.15); color: #fff; }
        .sidebar .nav-link i { width: 20px; }
        .main-content { margin-left: 240px; padding: 30px; }
        .topbar { background: #fff; padding: 14px 24px; border-radius: 12px; margin-bottom: 24px; box-shadow: 0 1px 4px rgba(0,0,0,0.08); display: flex; justify-content: space-between; align-items: center; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .table th { background: #f8fafc; font-weight: 600; color: #374151; }
        .table tbody tr:hover { background: #f0f7ff; }
        .btn-add    { background: #16a34a; color: #fff; }
        .btn-add:hover { background: #15803d; color: #fff; }
        .btn-edit   { background: #2563eb; color: #fff; }
        .btn-edit:hover { background: #1d4ed8; color: #fff; }
        .btn-del    { background: #dc2626; color: #fff; }
        .btn-del:hover { background: #b91c1c; color: #fff; }
        @media(max-width:768px){ .sidebar{display:none;} .main-content{margin-left:0;padding:16px;} }
    </style>
</head>
<body>
<!-- Sidebar -->
<div class="sidebar">
    <div class="brand"><i class="fas fa-graduation-cap me-2"></i>SMS Panel</div>
    <nav class="mt-3">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
        </a>

        @if(auth()->check() && auth()->user()->isAdmin())
            <a href="{{ route('admin.students.create') }}" class="nav-link {{ request()->routeIs('admin.students.create') ? 'active' : '' }}">
                <i class="fas fa-user-plus me-2"></i>Add Student
            </a>
            <a href="{{ route('admin.students.index') }}" class="nav-link {{ request()->routeIs('admin.students.index') ? 'active' : '' }}">
                <i class="fas fa-users me-2"></i>View Students
            </a>
            <a href="{{ route('admin.courses.index') }}" class="nav-link {{ request()->routeIs('admin.courses.index') ? 'active' : '' }}">
                <i class="fas fa-book-open me-2"></i>View Courses
            </a>
        @elseif(auth()->check() && auth()->user()->isStudent())
            <a href="{{ route('student.courses.index') }}" class="nav-link {{ request()->routeIs('student.courses.index') ? 'active' : '' }}">
                <i class="fas fa-book me-2"></i>View Courses
            </a>
            <a href="{{ route('student.testimonials.index') }}" class="nav-link {{ request()->routeIs('student.testimonials.index') ? 'active' : '' }}">
                <i class="fas fa-quote-left me-2"></i>Testimonials
            </a>
        @endif

        <a href="{{ route('logout') }}" class="nav-link mt-4"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt me-2"></i>Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </nav>
</div>

<!-- Main content -->
<div class="main-content">
    <div class="topbar">
        <span class="fw-semibold text-secondary">Welcome, <strong>{{ Auth::user()->name }}</strong> 👋</span>
        <span class="text-muted small"><i class="fas fa-calendar-alt me-1"></i>{{ now()->format('D, d M Y') }}</span>
    </div>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
            <i class="fas fa-times-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(isset($slot))
        {{ $slot }}
    @else
        @yield('content')
    @endif
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('scripts')
</body>
</html>