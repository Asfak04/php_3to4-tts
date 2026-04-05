@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
    <h1 class="h3 page-title"><i class="bi bi-person-plus me-2"></i>New Author Profile</h1>
    <a href="{{ route('authors.index') }}" class="btn btn-outline-secondary d-flex align-items-center shadow-sm">
        <i class="bi bi-arrow-left me-2"></i> Back to Authors
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card border-0 shadow-sm">
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

                <form action="{{ route('authors.store') }}" method="POST">
                    @csrf
                    <div class="row g-4">
                        <div class="col-12">
                            <label for="name" class="form-label fw-medium"><i class="bi bi-type me-2"></i>Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required placeholder="e.g., Robert Cecil Martin">
                        </div>

                        <div class="col-12">
                            <label for="photo_url" class="form-label fw-medium"><i class="bi bi-image me-2"></i>Profile Image URL (Optional)</label>
                            <input type="url" class="form-control" id="photo_url" name="photo_url" value="{{ old('photo_url') }}" placeholder="https://example.com/photo.jpg">
                            <div class="form-text small text-muted">Use a link to a professional headshot.</div>
                        </div>

                        <div class="col-12">
                            <label for="bio" class="form-label fw-medium"><i class="bi bi-justify-left me-2"></i>Biography</label>
                            <textarea class="form-control" id="bio" name="bio" rows="5" placeholder="Short biography about the author's work and style...">{{ old('bio') }}</textarea>
                        </div>

                        <div class="col-12 d-grid mt-4">
                            <button type="submit" class="btn btn-primary py-2 fw-semibold">
                                Create Author Profile <i class="bi bi-check-lg ms-2"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
