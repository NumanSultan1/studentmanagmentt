@extends('layouts.admin')

@section('content')
<div class="card card-custom">
    <div class="card-body p-4">
        <h5 class="mb-4 fw-bold"><i class="fa-solid fa-quote-left me-2 text-primary"></i>Testimonials Management</h5>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm p-3 mb-4" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Student Details</th>
                        <th>Course / Program</th>
                        <th>Review content</th>
                        <th>Rating</th>
                        <th>Landing Page</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials as $index => $testimonial)
                        <tr>
                            <td>{{ $testimonials->firstItem() + $index }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ !str_starts_with($testimonial->student_image ?? '', 'http') && $testimonial->student_image ? asset('storage/' . $testimonial->student_image) : ($testimonial->student_image ?? 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=150&q=80') }}" class="rounded-circle me-3 border" style="width: 45px; height: 45px; object-fit: cover;">
                                    <span class="fw-bold text-dark">{{ $testimonial->student_name }}</span>
                                </div>
                            </td>
                            <td>{{ $testimonial->course ?? 'General Feedback' }}</td>
                            <td><p class="text-secondary small mb-0" style="max-width: 300px;">"{{ Str::limit($testimonial->content, 100) }}"</p></td>
                            <td class="text-warning">
                                @for($i = 0; $i < $testimonial->rating; $i++)
                                    <i class="fa-solid fa-star small"></i>
                                @endfor
                                @for($i = $testimonial->rating; $i < 5; $i++)
                                    <i class="fa-regular fa-star small text-muted"></i>
                                @endfor
                            </td>
                            <td>
                                <form action="{{ route('admin.testimonials.toggle-feature', $testimonial) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $testimonial->is_featured ? 'btn-success' : 'btn-outline-secondary' }} rounded-3">
                                        @if($testimonial->is_featured)
                                            <i class="fa-solid fa-circle-check me-1"></i> Featured
                                        @else
                                            <i class="fa-solid fa-circle me-1"></i> Not Featured
                                        @endif
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this testimonial?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger rounded-3" title="Delete Review"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">No reviews found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $testimonials->links() }}
        </div>
    </div>
</div>
@endsection
