<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — Student Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-card {
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .auth-icon {
            width: 70px; height: 70px;
            background: linear-gradient(135deg, #16a34a, #15803d);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.8rem; color: #fff;
        }
        .form-control:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,0.15); }
        .btn-register {
            background: linear-gradient(135deg, #16a34a, #15803d);
            color: #fff; border: none;
            padding: 12px; font-size: 1rem; font-weight: 600;
            border-radius: 10px; width: 100%;
            transition: opacity .2s;
        }
        .btn-register:hover { opacity: 0.9; color: #fff; }
        .divider { text-align: center; color: #9ca3af; margin: 16px 0; font-size: .9rem; }
    </style>
</head>
<body>
<div class="auth-card">
    <div class="auth-icon"><i class="fas fa-user-plus"></i></div>
    <h4 class="text-center fw-bold mb-1">Create Account</h4>
    <p class="text-center text-muted mb-4">Register to manage students</p>

    @if($errors->any())
        <div class="alert alert-danger rounded-3">
            <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Full Name</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user text-muted"></i></span>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="form-control @error('name') is-invalid @enderror"
                       placeholder="Your full name" required autofocus>
            </div>
            @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Email Address</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope text-muted"></i></span>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="form-control @error('email') is-invalid @enderror"
                       placeholder="you@email.com" required>
            </div>
            @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock text-muted"></i></span>
                <input type="password" name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Min. 8 characters" required>
            </div>
            @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="form-label fw-semibold">Confirm Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock text-muted"></i></span>
                <input type="password" name="password_confirmation"
                       class="form-control" placeholder="Repeat password" required>
            </div>
        </div>
        <button type="submit" class="btn-register">
            <i class="fas fa-user-plus me-2"></i>Create Account
        </button>
    </form>

    <div class="divider">— Already have an account? —</div>

    <a href="{{ route('login') }}" class="btn btn-outline-primary w-100 rounded-3 py-2 fw-semibold">
        <i class="fas fa-sign-in-alt me-2"></i>Back to Login
    </a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>