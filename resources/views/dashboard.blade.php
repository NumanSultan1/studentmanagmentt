@extends('layouts.app')
@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card text-white" style="background:linear-gradient(135deg,#2563eb,#1e40af)">
            <div class="card-body d-flex align-items-center gap-3 p-4">
                <div style="font-size:2.5rem"><i class="fas fa-users"></i></div>
                <div>
                    <div style="font-size:2rem;font-weight:700">{{ $count }}</div>
                    <div class="opacity-75">Total Students</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex gap-3">
    <a href="{{ route('students.create') }}" class="btn btn-add btn-lg px-4">
        <i class="fas fa-user-plus me-2"></i>Add Student
    </a>
    <a href="{{ route('students.index') }}" class="btn btn-edit btn-lg px-4">
        <i class="fas fa-users me-2"></i>View Students
    </a>
</div>
@endsection