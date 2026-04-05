@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4 pb-2">
    <h1 class="h3 page-title"><i class="bi bi-pencil-square me-2"></i>Modify Book Title</h1>
    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary d-flex align-items-center bg-white shadow-sm border-0">
        <i class="bi bi-arrow-left me-2"></i> Back to Inventory
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">
        <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold mb-0 text-dark">Updating: {{ $book->title }}</h5>
                <p class="text-muted small">Current copies issued: {{ $book->total_quantity - $book->available_quantity }}</p>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('books.update', $book->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-floating mb-4 position-relative">
                        <input type="text" class="form-control bg-light border-0 shadow-none @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $book->title) }}" placeholder="The Great Gatsby" required style="border-bottom: 2px solid #e9ecef !important; border-radius: 8px 8px 0 0;">
                        <label for="title" class="text-muted"><i class="bi bi-book me-2"></i>Book Title</label>
                        @error('title') <div class="invalid-feedback position-absolute">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="category_id" class="form-label small fw-bold text-muted mb-1"><i class="bi bi-tag me-2"></i>Book Category</label>
                        <select class="form-select bg-light border-0 shadow-none @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required style="border-bottom: 2px solid #e9ecef !important; border-radius: 8px 8px 0 0; padding: 12px 15px;">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="invalid-feedback text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="author_id" class="form-label small fw-bold text-muted mb-1"><i class="bi bi-pen me-2"></i>Select Author</label>
                        <select class="form-select bg-light border-0 shadow-none @error('author_id') is-invalid @enderror" id="author_id" name="author_id" required style="border-bottom: 2px solid #e9ecef !important; border-radius: 8px 8px 0 0; padding: 12px 15px;">
                            <option value="">Select Author</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}" {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                            @endforeach
                        </select>
                        @error('author_id') <div class="invalid-feedback text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-floating mb-5 position-relative">
                        <input type="number" class="form-control bg-light border-0 shadow-none @error('total_quantity') is-invalid @enderror" id="total_quantity" name="total_quantity" value="{{ old('total_quantity', $book->total_quantity) }}" min="0" required style="border-bottom: 2px solid #e9ecef !important; border-radius: 8px 8px 0 0;">
                        <label for="total_quantity" class="text-muted"><i class="bi bi-boxes me-2"></i>Total Quantity Configuration</label>
                        @error('total_quantity') <div class="invalid-feedback position-absolute">{{ $message }}</div> @enderror
                        <div class="form-text mt-2"><i class="bi bi-info-circle me-1"></i>Cannot reduce quantity below the number of books already issued.</div>
                    </div>

                    <div class="d-grid mt-2">
                        <button type="submit" class="btn text-white py-3 shadow-sm border-0" style="background: linear-gradient(135deg, #FF9A9E 0%, #FECFEF 100%); background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: #0a4f32 !important; border-radius: 8px; font-weight: 600; letter-spacing: 0.5px;">
                            <i class="bi bi-floppy me-2"></i> Commit Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
