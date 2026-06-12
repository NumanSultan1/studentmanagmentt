@extends('layouts.admin')

@section('content')
<div class="card card-custom">
    <div class="card-body p-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-bold"><i class="fa-solid fa-cloud-arrow-up me-2 text-primary"></i>Upload Gallery Image</h5>
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary btn-action"><i class="fa-solid fa-arrow-left me-1"></i> Back</a>
        </div>

        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Asset Title (Optional)</label>
                    <input type="text" name="title" class="form-control" placeholder="Computer Lab, library, etc.">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-secondary">Select Image File</label>
                    <input type="file" name="image" id="imageInput" class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold text-secondary">Description (Optional)</label>
                    <textarea name="description" rows="3" class="form-control" placeholder="Short description of the photo..."></textarea>
                </div>
                <div class="col-12 mt-3 text-center">
                    <img id="imagePreview" src="#" alt="Upload Preview" class="img-fluid rounded border shadow-sm" style="max-height: 250px; display: none;">
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary px-5 py-3"><i class="fa-solid fa-check me-2"></i> Upload to Gallery</button>
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
                preview.style.display = 'inline-block';
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
