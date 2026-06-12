@extends('layouts.admin')

@section('content')
<div class="card card-custom">
    <div class="card-body p-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-bold"><i class="fa-solid fa-images me-2 text-primary"></i>Gallery Management</h5>
            <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary btn-action mt-2 mt-sm-0">
                <i class="fa-solid fa-cloud-arrow-up me-1"></i> Upload Image
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm p-3 mb-4" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4 mt-2">
            @forelse($galleryItems as $item)
                <div class="col-sm-6 col-md-4 col-xl-3">
                    <div class="card h-100 border rounded-3 overflow-hidden shadow-sm">
                        <img src="{{ !str_starts_with($item->image_path, 'http') ? asset('storage/' . $item->image_path) : $item->image_path }}" class="card-img-top" alt="{{ $item->title }}" style="height: 180px; object-fit: cover;">
                        <div class="p-3 d-flex flex-column justify-content-between h-100">
                            <div>
                                <h6 class="fw-bold mb-1 text-dark">{{ $item->title ?? 'Untitled Asset' }}</h6>
                                <p class="text-secondary small card-text mb-3">{{ Str::limit($item->description, 60) ?? 'No description.' }}</p>
                            </div>
                            <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger w-100"><i class="fa-solid fa-trash-can me-1"></i> Delete Image</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">No images found in the gallery.</div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $galleryItems->links() }}
        </div>
    </div>
</div>
@endsection
