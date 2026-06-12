@extends('layouts.admin')

@section('content')
<div class="card card-custom">
    <div class="card-body p-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-bold"><i class="fa-solid fa-file-pen me-2 text-primary"></i>Edit Course details</h5>
            <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary btn-action"><i class="fa-solid fa-arrow-left me-1"></i> Back</a>
        </div>

        <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <div class="col-md-8">
                    <label class="form-label fw-semibold text-secondary">Course Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $course->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-secondary">Academic Semester</label>
                    <select name="semester" class="form-select @error('semester') is-invalid @enderror" required>
                        <option value="1st Semester" {{ old('semester', $course->semester) == '1st Semester' ? 'selected' : '' }}>1st Semester</option>
                        <option value="2nd Semester" {{ old('semester', $course->semester) == '2nd Semester' ? 'selected' : '' }}>2nd Semester</option>
                        <option value="3rd Semester" {{ old('semester', $course->semester) == '3rd Semester' ? 'selected' : '' }}>3rd Semester</option>
                        <option value="4th Semester" {{ old('semester', $course->semester) == '4th Semester' ? 'selected' : '' }}>4th Semester</option>
                        <option value="5th Semester" {{ old('semester', $course->semester) == '5th Semester' ? 'selected' : '' }}>5th Semester</option>
                        <option value="6th Semester" {{ old('semester', $course->semester) == '6th Semester' ? 'selected' : '' }}>6th Semester</option>
                        <option value="7th Semester" {{ old('semester', $course->semester) == '7th Semester' ? 'selected' : '' }}>7th Semester</option>
                        <option value="8th Semester" {{ old('semester', $course->semester) == '8th Semester' ? 'selected' : '' }}>8th Semester</option>
                    </select>
                    @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Instructor</label>
                    <input type="text" name="instructor" class="form-control @error('instructor') is-invalid @enderror" value="{{ old('instructor', $course->instructor) }}" required>
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
                        <img id="imagePreview" src="{{ !str_starts_with($course->image ?? '', 'http') && $course->image ? asset('storage/' . $course->image) : ($course->image ?? 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=150&q=80') }}" alt="Course Image" class="rounded border" style="width: 150px; height: 100px; object-fit: cover;">
                    </div>
                </div>
                <div class="col-12 d-flex align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="featuredCheck" {{ old('is_featured', $course->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold text-secondary" for="featuredCheck">
                            Feature this course on public Landing Page
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold text-secondary">Course Syllabus/Description</label>
                    <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $course->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary px-5 py-3"><i class="fa-solid fa-square-check me-2"></i> Update Course Details</button>
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
                document.getElementById('imagePreview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
