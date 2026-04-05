@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4 pb-2">
    <h1 class="h3 page-title"><i class="bi bi-journal-plus me-2"></i>Register New Book</h1>
    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary d-flex align-items-center bg-white shadow-sm border-0">
        <i class="bi bi-arrow-left me-2"></i> Back to Inventory
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">
        <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold mb-0 text-dark">Book Meta Information</h5>
                <p class="text-muted small">Fill in the literary details and total available copies.</p>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('books.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-floating mb-4 position-relative">
                        <input type="text" class="form-control bg-light border-0 shadow-none @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="The Great Gatsby" required style="border-bottom: 2px solid #e9ecef !important; border-radius: 8px 8px 0 0;">
                        <label for="title" class="text-muted"><i class="bi bi-book me-2"></i>Book Title</label>
                        @error('title') <div class="invalid-feedback position-absolute">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="category_id" class="form-label small fw-bold text-muted mb-1"><i class="bi bi-tag me-2"></i>Book Category</label>
                        <select class="form-select bg-light border-0 shadow-none @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required style="border-bottom: 2px solid #e9ecef !important; border-radius: 8px 8px 0 0; padding: 12px 15px;">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="invalid-feedback text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="author_id" class="form-label small fw-bold text-muted mb-1"><i class="bi bi-pen me-2"></i>Select Author</label>
                        <select class="form-select bg-light border-0 shadow-none @error('author_id') is-invalid @enderror" id="author_id" name="author_id" required style="border-bottom: 2px solid #e9ecef !important; border-radius: 8px 8px 0 0; padding: 12px 15px;">
                            <option value="">Select Author</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                            @endforeach
                        </select>
                        @error('author_id') <div class="invalid-feedback text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-floating mb-5 position-relative">
                        <input type="number" class="form-control bg-light border-0 shadow-none @error('total_quantity') is-invalid @enderror" id="total_quantity" name="total_quantity" value="{{ old('total_quantity', 1) }}" min="1" required style="border-bottom: 2px solid #e9ecef !important; border-radius: 8px 8px 0 0;">
                        <label for="total_quantity" class="text-muted"><i class="bi bi-boxes me-2"></i>Total Initial Quantity</label>
                        @error('total_quantity') <div class="invalid-feedback position-absolute">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-grid mt-2">
                        <button type="submit" class="btn btn-primary py-3 shadow-sm border-0" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); border-radius: 8px; font-weight: 600; letter-spacing: 0.5px;">
                            <i class="bi bi-bookmark-plus me-2 fs-5"></i> Save Book Record
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
