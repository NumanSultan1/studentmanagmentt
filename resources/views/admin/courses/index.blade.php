@extends('layouts.admin')

@section('content')
<div class="card card-custom">
    <div class="card-body p-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-bold"><i class="fa-solid fa-book-open me-2 text-primary"></i>Course Management</h5>
            <a href="{{ route('admin.courses.create') }}" class="btn btn-primary btn-action mt-2 mt-sm-0">
                <i class="fa-solid fa-plus me-1"></i> Add New Course
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm p-3 mb-4" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Search Bar -->
        <form method="GET" action="{{ route('admin.courses.index') }}" class="mb-4">
            <div class="input-group" style="max-width: 450px">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control rounded-start-3" placeholder="Search by title, instructor, or semester...">
                <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                @if(request('search'))
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary">Clear</a>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Course Details</th>
                        <th>Instructor</th>
                        <th>Academic Semester</th>
                        <th>Featured</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($courses as $index => $course)
                        <tr>
                            <td>{{ $courses->firstItem() + $index }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ !str_starts_with($course->image ?? '', 'http') && $course->image ? asset('storage/' . $course->image) : ($course->image ?? 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=150&q=80') }}" class="rounded-3 me-3 border" style="width: 60px; height: 45px; object-fit: cover;">
                                    <div>
                                        <div class="fw-bold text-dark">{{ $course->title }}</div>
                                        <small class="text-secondary">{{ Str::limit($course->description, 60) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $course->instructor }}</td>
                            <td><span class="badge bg-primary-subtle text-primary"><i class="fa-solid fa-calendar-days me-1"></i> {{ $course->semester }}</span></td>
                            <td>
                                @if($course->is_featured)
                                    <span class="badge bg-success-subtle text-success"><i class="fa-solid fa-circle-check me-1"></i> Featured</span>
                                @else
                                    <span class="badge bg-light text-secondary">No</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.courses.show', $course) }}" class="btn btn-sm btn-info text-white rounded-3" title="View details"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-sm btn-warning text-white rounded-3" title="Edit course"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this course?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger rounded-3" title="Delete course"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">No course records found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $courses->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
