@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
    <h1 class="h3 page-title"><i class="bi bi-tag me-2"></i>Add New Category</h1>
    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary d-flex align-items-center shadow-sm">
        <i class="bi bi-arrow-left me-2"></i> Back to Categories
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
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

                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="form-label fw-medium"><i class="bi bi-fonts me-2"></i>Category Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required placeholder="e.g., Computer Science, History">
                        <div class="form-text">This will be used to organize books in the directory.</div>
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-primary py-2 fw-semibold">
                            Create Category <i class="bi bi-check-lg ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
