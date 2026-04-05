@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
    <h1 class="h3 page-title"><i class="bi bi-key me-2"></i>Reset Student Password</h1>
    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary d-flex align-items-center shadow-sm">
        <i class="bi bi-arrow-left me-2"></i> Back to Directory
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 border-0">
                <div class="d-flex align-items-center">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; font-weight: 600;">
                        {{ strtoupper(substr($student->name, 0, 1)) }}
                    </div>
                    <div>
                        <h5 class="mb-0 text-dark">{{ $student->name }}</h5>
                        <p class="mb-0 text-muted small"><i class="bi bi-envelope me-1"></i> {{ $student->email }}</p>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                @if ($errors->any())
                    <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 10px;">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('students.reset-password.update', $student->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="password" class="form-label fw-medium"><i class="bi bi-lock me-2"></i>New Password</label>
                        <input type="password" class="form-control" id="password" name="password" required placeholder="Min 6 characters">
                        <div class="form-text">Choose a secure password for the student.</div>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-medium"><i class="bi bi-lock-fill me-2"></i>Confirm New Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Repeat new password">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary py-2 fw-semibold">
                            Update Student Password <i class="bi bi-check-lg ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="alert alert-info border-0 shadow-sm mt-4 d-flex align-items-start" style="border-radius: 10px;">
            <i class="bi bi-info-circle-fill me-3 mt-1 fs-5"></i>
            <div>
                <h6 class="alert-heading fw-bold mb-1">Administrative Note</h6>
                <p class="mb-0 small text-muted">Resetting this password will immediately update the login credentials for <strong>{{ $student->name }}</strong>. Please ensure the student is notified of their new credentials.</p>
            </div>
        </div>
    </div>
</div>
@endsection
