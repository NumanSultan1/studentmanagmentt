@extends('layouts.admin')

@section('content')
<div class="card card-custom">
    <div class="card-body p-4">
        <h5 class="mb-4 fw-bold"><i class="fa-solid fa-envelope-open-text me-2 text-primary"></i>Contact Messages Inbox</h5>

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
                        <th>Sender Details</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Date Received</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $index => $msg)
                        <tr class="{{ !$msg->is_read ? 'table-warning' : '' }}">
                            <td>{{ $messages->firstItem() + $index }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $msg->name }}</div>
                                <small class="text-secondary">{{ $msg->email }}</small>
                            </td>
                            <td>{{ Str::limit($msg->subject, 50) }}</td>
                            <td>
                                @if($msg->is_read)
                                    <span class="badge bg-success-subtle text-success">Read</span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning">Unread</span>
                                @endif
                            </td>
                            <td class="small text-secondary">{{ $msg->created_at->format('M d, Y - h:i A') }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-sm btn-info text-white rounded-3" title="Read message"><i class="fa-solid fa-envelope-open"></i></a>
                                    
                                    <form action="{{ route('admin.messages.toggle-read', $msg) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-secondary rounded-3" title="Toggle read/unread status">
                                            @if($msg->is_read)
                                                <i class="fa-regular fa-envelope"></i>
                                            @else
                                                <i class="fa-solid fa-envelope-circle-check"></i>
                                            @endif
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger rounded-3" title="Delete message"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">No contact messages in your inbox.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $messages->links() }}
        </div>
    </div>
</div>
@endsection
