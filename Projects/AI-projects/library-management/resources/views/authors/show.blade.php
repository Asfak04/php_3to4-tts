@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
    <h1 class="h3 page-title"><i class="bi bi-person-badge me-2"></i>Author Profile</h1>
    <a href="{{ route('authors.index') }}" class="btn btn-outline-secondary d-flex align-items-center shadow-sm">
        <i class="bi bi-arrow-left me-2"></i> Back to Authors
    </a>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-center p-4 h-100">
            <div class="mb-4">
                @if($author->photo_url)
                    <img src="{{ $author->photo_url }}" class="rounded-circle shadow-sm border border-4 border-white" style="width: 150px; height: 150px; object-fit: cover;" alt="{{ $author->name }}">
                @else
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm border border-4 border-white" style="width: 150px; height: 150px; font-weight: 600; font-size: 3rem;">
                        {{ strtoupper(substr($author->name, 0, 1)) }}
                    </div>
                @endif
            </div>
            <h4 class="mb-1 fw-bold">{{ $author->name }}</h4>
            <p class="text-muted"><i class="bi bi-quill me-1"></i> Library Contributor</p>
            
            <hr class="my-4 opacity-10">
            
            <div class="text-start">
                <h6 class="fw-bold small text-uppercase text-muted mb-3">Biography</h6>
                <p class="text-muted small lh-lg mb-0 text-justify">
                    {{ $author->bio ?? 'No biography information provided. This author has contributed several titles to our library collection.' }}
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold"><i class="bi bi-book-half me-2 text-primary"></i>Publications in Library</h5>
                <span class="badge bg-soft-primary text-primary rounded-pill px-3 fs-6">{{ $author->books->count() }} Books</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Title</th>
                                <th>Category</th>
                                <th class="text-center">Stock</th>
                                <th class="text-end pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($author->books as $book)
                            <tr>
                                <td class="ps-4">
                                    <span class="fw-medium text-dark">{{ $book->title }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-soft-secondary text-secondary rounded-pill px-3">{{ $book->category->name ?? 'Uncategorized' }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="small fw-medium {{ $book->available_quantity > 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $book->available_quantity }} / {{ $book->total_quantity }} Available
                                    </div>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('books.index') }}?category={{ $book->category_id }}" class="btn btn-sm btn-light border rounded-pill px-3">View Library <i class="bi bi-arrow-right ms-1"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <i class="bi bi-journal-x text-muted" style="font-size: 2.5rem;"></i>
                                    <p class="mt-3 text-muted mb-0">No books found for this author currently.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
