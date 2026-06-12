@extends('layouts.admin')

@section('content')
<div class="card card-custom">
    <div class="card-body p-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-bold"><i class="fa-solid fa-square-plus me-2 text-primary"></i>Add New Course</h5>
            <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary btn-action"><i class="fa-solid fa-arrow-left me-1"></i> Back</a>
        </div>

        <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-md-8">
                    <label class="form-label fw-semibold text-secondary">Course Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Introduction to Web Development, etc." required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-secondary">Academic Semester</label>
                    <select name="semester" class="form-select @error('semester') is-invalid @enderror" required>
                        <option value="">Select Semester</option>
                        <option value="1st Semester" {{ old('semester') == '1st Semester' ? 'selected' : '' }}>1st Semester</option>
                        <option value="2nd Semester" {{ old('semester') == '2nd Semester' ? 'selected' : '' }}>2nd Semester</option>
                        <option value="3rd Semester" {{ old('semester') == '3rd Semester' ? 'selected' : '' }}>3rd Semester</option>
                        <option value="4th Semester" {{ old('semester') == '4th Semester' ? 'selected' : '' }}>4th Semester</option>
                        <option value="5th Semester" {{ old('semester') == '5th Semester' ? 'selected' : '' }}>5th Semester</option>
                        <option value="6th Semester" {{ old('semester') == '6th Semester' ? 'selected' : '' }}>6th Semester</option>
                        <option value="7th Semester" {{ old('semester') == '7th Semester' ? 'selected' : '' }}>7th Semester</option>
                        <option value="8th Semester" {{ old('semester') == '8th Semester' ? 'selected' : '' }}>8th Semester</option>
                    </select>
                    @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Instructor</label>
                    <input type="text" name="instructor" class="form-control @error('instructor') is-invalid @enderror" value="{{ old('instructor') }}" placeholder="Dr. John Smith" required>
                    @error('instructor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Course Card Image</label>
                    <input type="file" name="image" id="imageInput" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="mt-3">
                        <img id="imagePreview" src="#" alt="Image Preview" class="rounded border" style="width: 150px; height: 100px; object-fit: cover; display: none;">
                    </div>
                </div>
                <div class="col-12 d-flex align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="featuredCheck" {{ old('is_featured') ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold text-secondary" for="featuredCheck">
                            Feature this course on public Landing Page
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold text-secondary">Course Syllabus/Description</label>
                    <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Detailed description of course syllabus..." required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary px-5 py-3"><i class="fa-solid fa-floppy-disk me-2"></i> Save Course</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('imageInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('imagePreview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
