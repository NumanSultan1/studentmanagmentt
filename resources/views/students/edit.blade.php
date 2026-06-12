@extends('layouts.app')
@section('content')
<div class="card" style="max-width:600px">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-4"><i class="fas fa-edit me-2 text-primary"></i>Edit Student</h5>
        <form action="{{ route('students.update', $student) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" value="{{ old('name', $student->name) }}"
                       class="form-control @error('name') is-invalid @enderror">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" value="{{ old('email', $student->email) }}"
                       class="form-control @error('email') is-invalid @enderror">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $student->phone) }}"
                       class="form-control @error('phone') is-invalid @enderror">
                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Address</label>
                <textarea name="address" rows="3"
                          class="form-control @error('address') is-invalid @enderror">{{ old('address', $student->address) }}</textarea>
                @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-edit px-4">
                    <i class="fas fa-save me-2"></i>Update Student
                </button>
                <a href="{{ route('students.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection