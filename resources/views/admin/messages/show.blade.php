@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0 fw-bold"><i class="fa-solid fa-envelope-open-text me-2 text-primary"></i>Message Details</h5>
        <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary btn-action"><i class="fa-solid fa-arrow-left me-1"></i> Back to Inbox</a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <div class="card card-custom p-4">
                <div class="d-flex justify-content-between align-items-start border-bottom pb-3 mb-4">
                    <div>
                        <h4 class="fw-bold text-dark mb-1">{{ $message->subject }}</h4>
                        <span class="text-secondary small">From: <strong class="text-dark">{{ $message->name }}</strong> ({{ $message->email }})</span>
                    </div>
                    <div class="text-end">
                        <span class="text-secondary small d-block">{{ $message->created_at->format('M d, Y - h:i A') }}</span>
                        <span class="badge bg-success-subtle text-success mt-2">Read</span>
                    </div>
                </div>

                <div class="p-3 bg-light rounded-3 text-secondary mb-4" style="min-height: 180px; white-space: pre-wrap; font-size: 1.05rem; line-height: 1.6;">{{ $message->message }}</div>

                <div class="d-flex justify-content-end gap-2 border-top pt-3">
                    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-action px-4"><i class="fa-solid fa-trash-can me-2"></i> Delete message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
