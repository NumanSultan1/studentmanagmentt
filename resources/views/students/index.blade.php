@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-bold"><i class="fas fa-users me-2 text-primary"></i>All Students</h5>
            <a href="{{ route('students.create') }}" class="btn btn-add">
                <i class="fas fa-plus me-1"></i>Add Student
            </a>
        </div>

        {{-- Search bar --}}
        <form method="GET" action="{{ route('students.index') }}" class="mb-4">
            <div class="input-group" style="max-width:400px">
                <input type="text" name="search" value="{{ request('search') }}"
                       class="form-control" placeholder="Search by name or email…">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                @if(request('search'))
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Clear</a>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th><th>Name</th><th>Email</th>
                        <th>Phone</th><th>Address</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $i => $student)
                    <tr>
                        <td>{{ $students->firstItem() + $i }}</td>
                        <td><strong>{{ $student->name }}</strong></td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->phone ?? '—' }}</td>
                        <td>{{ Str::limit($student->address, 30) ?? '—' }}</td>
                        <td>
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-edit btn-sm me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline delete-form">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-del btn-sm btn-delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">No students found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {{ $students->withQueryString()->links() }}
        </div>
    </div>
</div>

@push('scripts')
<script>
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function () {
        Swal.fire({
            title: 'Delete this student?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, delete'
        }).then(result => {
            if (result.isConfirmed) {
                this.closest('form').submit();
            }
        });
    });
});
</script>
@endpush
@endsection