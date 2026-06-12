@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0 fw-bold"><i class="fa-solid fa-id-card me-2 text-primary"></i>Student Profile Details</h5>
        <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary btn-action"><i class="fa-solid fa-arrow-left me-1"></i> Back to List</a>
    </div>

    <div class="row g-4">
        <!-- Profile Card -->
        <div class="col-lg-4">
            <div class="card card-custom text-center p-4">
                <div class="my-3">
                    <img src="{{ $student->image ? asset('storage/' . $student->image) : 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=150&q=80' }}" alt="{{ $student->name }}" class="rounded-circle border border-3 border-primary shadow-sm" style="width: 150px; height: 150px; object-fit: cover;">
                </div>
                <h4 class="fw-bold text-dark mb-1">{{ $student->name }}</h4>
                <p class="text-secondary small mb-3">ID: ST-{{ str_pad($student->id, 5, '0', STR_PAD_LEFT) }}</p>
                <div class="d-flex justify-content-center gap-2 mb-4">
                    <span class="badge bg-primary px-3 py-2 fs-7">{{ $student->department }}</span>
                    <span class="badge bg-secondary px-3 py-2 fs-7">{{ $student->semester }} Semester</span>
                </div>
                <hr>
                <div class="d-flex justify-content-around mt-3">
                    <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-sm btn-warning text-white px-3"><i class="fa-solid fa-pen-to-square me-1"></i> Edit Profile</a>
                </div>
            </div>
        </div>

        <!-- Academic and Personal Info -->
        <div class="col-lg-8">
            <div class="card card-custom p-4 h-100">
                <h5 class="fw-bold text-dark mb-4 pb-2 border-bottom"><i class="fa-solid fa-circle-info me-2 text-primary"></i>General Profile Information</h5>
                
                <div class="row g-3 mb-4">
                    <div class="col-sm-6">
                        <span class="text-secondary small d-block">Official Email Address</span>
                        <strong class="text-dark">{{ $student->email }}</strong>
                    </div>
                    <div class="col-sm-6">
                        <span class="text-secondary small d-block">Phone Number</span>
                        <strong class="text-dark">{{ $student->phone ?? 'Not provided' }}</strong>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <span class="text-secondary small d-block">Department Name</span>
                        <strong class="text-dark">{{ $student->department }}</strong>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <span class="text-secondary small d-block">Current Term / Semester</span>
                        <strong class="text-dark">{{ $student->semester }} Semester</strong>
                    </div>
                </div>

                <h5 class="fw-bold text-dark mb-3 pt-3 border-top"><i class="fa-solid fa-location-dot me-2 text-primary"></i>Residential Info</h5>
                <div class="row g-3">
                    <div class="col-12">
                        <span class="text-secondary small d-block">Home / Mailing Address</span>
                        <p class="text-dark mb-0">{{ $student->address ?? 'No address information is on record.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
