@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="row g-4 mb-4">
        <!-- Stat Cards -->
        <div class="col-sm-6 col-xl-3">
            <div class="card card-custom p-4">
                <div class="d-flex align-items-center">
                    <div class="bg-primary-subtle text-primary rounded-3 p-3 fs-3 me-3">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold">{{ $stats['students'] }}</h4>
                        <span class="text-secondary small">Total Students</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card card-custom p-4">
                <div class="d-flex align-items-center">
                    <div class="bg-success-subtle text-success rounded-3 p-3 fs-3 me-3">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold">{{ $stats['courses'] }}</h4>
                        <span class="text-secondary small">Active Courses</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card card-custom p-4">
                <div class="d-flex align-items-center">
                    <div class="bg-info-subtle text-info rounded-3 p-3 fs-3 me-3">
                        <i class="fa-solid fa-images"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold">{{ $stats['gallery'] }}</h4>
                        <span class="text-secondary small">Gallery Photos</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card card-custom p-4">
                <div class="d-flex align-items-center">
                    <div class="bg-warning-subtle text-warning rounded-3 p-3 fs-3 me-3">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold">{{ $stats['unread_messages'] }}</h4>
                        <span class="text-secondary small">Unread Messages</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Recent Students -->
        <div class="col-xl-6">
            <div class="card card-custom h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Recent Registrations</h5>
                    <a href="{{ route('admin.students.index') }}" class="btn btn-sm btn-outline-primary rounded-3 text-decoration-none">View All</a>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Email</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentStudents as $student)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $student->image ? asset('storage/' . $student->image) : 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=150&q=80' }}" class="rounded-circle me-2 border" style="width: 32px; height: 32px; object-fit: cover;">
                                                <span class="fw-semibold">{{ $student->name }}</span>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-secondary">{{ $student->department ?? 'General' }}</span></td>
                                        <td class="small text-secondary">{{ $student->email }}</td>
                                        <td class="small">{{ $student->created_at->format('M d, Y') }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center text-muted py-4">No recent students found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Contact Messages -->
        <div class="col-xl-6">
            <div class="card card-custom h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Recent Contact Messages</h5>
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-primary rounded-3 text-decoration-none">View All</a>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Sender</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentMessages as $msg)
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">{{ $msg->name }}</div>
                                            <small class="text-muted">{{ $msg->email }}</small>
                                        </td>
                                        <td><span class="text-dark small">{{ Str::limit($msg->subject, 30) }}</span></td>
                                        <td>
                                            @if($msg->is_read)
                                                <span class="badge bg-success-subtle text-success">Read</span>
                                            @else
                                                <span class="badge bg-warning-subtle text-warning">Unread</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-sm btn-primary rounded-circle"><i class="fa-solid fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center text-muted py-4">No recent queries found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
