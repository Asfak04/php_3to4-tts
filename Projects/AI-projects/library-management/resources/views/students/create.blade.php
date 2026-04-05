@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4 pb-2">
    <h1 class="h3 page-title"><i class="bi bi-person-plus me-2"></i>Add New Student</h1>
    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary d-flex align-items-center bg-white shadow-sm border-0">
        <i class="bi bi-arrow-left me-2"></i> Back to Directory
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">
        <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold mb-0 text-dark">Student Registration Details</h5>
                <p class="text-muted small">Enter the academic and contact details below.</p>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('students.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-floating mb-4 position-relative">
                        <input type="text" class="form-control bg-light @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="John Doe" required>
                        <label for="name" class="text-muted"><i class="bi bi-person me-2"></i>Full Name</label>
                        @error('name') <div class="invalid-feedback position-absolute">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-floating mb-4 position-relative">
                        <input type="email" class="form-control bg-light @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="email@example.com" required>
                        <label for="email" class="text-muted"><i class="bi bi-envelope me-2"></i>Email Address</label>
                        @error('email') <div class="invalid-feedback position-absolute">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-floating mb-5 position-relative">
                        <input type="text" class="form-control bg-light @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+1234567890">
                        <label for="phone" class="text-muted"><i class="bi bi-telephone me-2"></i>Phone Number</label>
                        @error('phone') <div class="invalid-feedback position-absolute">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-grid mt-2">
                        <button type="submit" class="btn btn-primary py-3 shadow-sm" style="border-radius: 8px; font-weight: 600; letter-spacing: 0.5px;">
                            <i class="bi bi-check2-circle me-2 fs-5"></i> Enroll Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
