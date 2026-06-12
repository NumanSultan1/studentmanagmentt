@extends('layouts.public')

@section('styles')
<style>
    .gallery-header {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.95), rgba(37, 99, 235, 0.9)), 
                    url('https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        color: #ffffff;
        padding: 80px 0;
        text-align: center;
    }
    .gallery-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        background-color: #ffffff;
        transition: all 0.3s ease;
    }
    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
    }
    .gallery-img-wrapper {
        height: 250px;
        overflow: hidden;
        position: relative;
    }
    .gallery-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .gallery-card:hover .gallery-img {
        transform: scale(1.06);
    }
    .gallery-overlay {
        position: absolute;
        inset: 0;
        background: rgba(15, 23, 42, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .gallery-card:hover .gallery-overlay {
        opacity: 1;
    }
</style>
@endsection

@section('content')

<!-- Header Banner -->
<section class="gallery-header">
    <div class="container py-3">
        <h1 class="display-4 fw-extrabold mb-3">Campus Gallery</h1>
        <p class="lead opacity-90 mx-auto" style="max-width: 600px;">Peek inside our campuses, high-tech labs, student events, and graduation ceremonies.</p>
    </div>
</section>

<!-- Gallery Grid -->
<section class="py-5 my-5">
    <div class="container">
        <div class="row g-4">
            @forelse($galleryItems as $item)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="gallery-card h-100">
                        <div class="gallery-img-wrapper">
                            <img src="{{ !str_starts_with($item->image_path, 'http') ? asset('storage/' . $item->image_path) : $item->image_path }}" class="gallery-img" alt="{{ $item->title }}">
                            <div class="gallery-overlay">
                                <span class="btn btn-light rounded-circle shadow"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h6 class="fw-bold mb-1">{{ $item->title ?? 'Campus Asset' }}</h6>
                            <p class="text-secondary small mb-0">{{ Str::limit($item->description, 80) ?? 'Educational institute facility.' }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    <i class="fa-solid fa-images display-1 mb-3 text-secondary opacity-50"></i>
                    <h4>No images found.</h4>
                    <p>The campus gallery will be updated with student event photographs soon.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
