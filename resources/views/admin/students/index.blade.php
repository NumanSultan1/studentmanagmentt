@extends('layouts.admin')

@section('content')
<div class="card card-custom">
    <div class="card-body p-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-bold"><i class="fa-solid fa-users me-2 text-primary"></i>Student Management</h5>
            <a href="{{ route('admin.students.create') }}" class="btn btn-primary btn-action mt-2 mt-sm-0">
                <i class="fa-solid fa-plus me-1"></i> Add Student Profile
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm p-3 mb-4" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Search Bar -->
        <form method="GET" action="{{ route('admin.students.index') }}" class="mb-4">
            <div class="input-group" style="max-width: 450px">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control rounded-start-3" placeholder="Search by name, email, or department...">
                <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                @if(request('search'))
                    <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary">Clear</a>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Student Details</th>
                        <th>Email Address</th>
                        <th>Department</th>
                        <th>Semester</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $index => $student)
                        <tr>
                            <td>{{ $students->firstItem() + $index }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ $student->image ? asset('storage/' . $student->image) : 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=150&q=80' }}" class="rounded-circle me-3 border" style="width: 45px; height: 45px; object-fit: cover;">
                                    <div>
                                        <div class="fw-bold text-dark">{{ $student->name }}</div>
                                        <small class="text-secondary">{{ $student->address ? Str::limit($student->address, 30) : 'No address set' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $student->email }}</td>
                            <td><span class="badge bg-primary-subtle text-primary">{{ $student->department }}</span></td>
                            <td><span class="badge bg-secondary-subtle text-secondary">{{ $student->semester }}</span></td>
                            <td>{{ $student->phone ?? '—' }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.students.show', $student) }}" class="btn btn-sm btn-info text-white rounded-3" title="View Profile"><i class="fa-solid fa-eye"></i></a>
                                    <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-sm btn-warning text-white rounded-3" title="Edit Student"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form action="{{ route('admin.students.destroy', $student) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this student record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger rounded-3" title="Delete Student"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">No student records found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $students->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
