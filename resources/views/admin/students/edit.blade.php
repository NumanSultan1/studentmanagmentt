@extends('layouts.admin')

@section('content')
<div class="card card-custom">
    <div class="card-body p-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-bold"><i class="fa-solid fa-user-pen me-2 text-primary"></i>Edit Student Profile</h5>
            <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary btn-action"><i class="fa-solid fa-arrow-left me-1"></i> Back</a>
        </div>

        <form action="{{ route('admin.students.update', $student) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Student Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $student->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Email Address</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $student->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Department</label>
                    <select name="department" class="form-select @error('department') is-invalid @enderror" required>
                        <option value="Computer Science" {{ old('department', $student->department) == 'Computer Science' ? 'selected' : '' }}>Computer Science</option>
                        <option value="Information Technology" {{ old('department', $student->department) == 'Information Technology' ? 'selected' : '' }}>Information Technology</option>
                        <option value="Software Engineering" {{ old('department', $student->department) == 'Software Engineering' ? 'selected' : '' }}>Software Engineering</option>
                        <option value="Cyber Security" {{ old('department', $student->department) == 'Cyber Security' ? 'selected' : '' }}>Cyber Security</option>
                    </select>
                    @error('department')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Current Semester</label>
                    <select name="semester" class="form-select @error('semester') is-invalid @enderror" required>
                        <option value="1st" {{ old('semester', $student->semester) == '1st' ? 'selected' : '' }}>1st Semester</option>
                        <option value="2nd" {{ old('semester', $student->semester) == '2nd' ? 'selected' : '' }}>2nd Semester</option>
                        <option value="3rd" {{ old('semester', $student->semester) == '3rd' ? 'selected' : '' }}>3rd Semester</option>
                        <option value="4th" {{ old('semester', $student->semester) == '4th' ? 'selected' : '' }}>4th Semester</option>
                        <option value="5th" {{ old('semester', $student->semester) == '5th' ? 'selected' : '' }}>5th Semester</option>
                        <option value="6th" {{ old('semester', $student->semester) == '6th' ? 'selected' : '' }}>6th Semester</option>
                        <option value="7th" {{ old('semester', $student->semester) == '7th' ? 'selected' : '' }}>7th Semester</option>
                        <option value="8th" {{ old('semester', $student->semester) == '8th' ? 'selected' : '' }}>8th Semester</option>
                    </select>
                    @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Phone Number</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $student->phone) }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Student Photo</label>
                    <input type="file" name="image" id="imageInput" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="mt-3">
                        <img id="imagePreview" src="{{ $student->image ? asset('storage/' . $student->image) : 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=150&q=80' }}" alt="Student Photo" class="rounded-circle border" style="width: 100px; height: 100px; object-fit: cover;">
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold text-secondary">Home Address</label>
                    <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror">{{ old('address', $student->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary px-5 py-3"><i class="fa-solid fa-square-check me-2"></i> Update Student Profile</button>
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
