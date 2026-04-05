@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
    <h1 class="h3 page-title"><i class="bi bi-journal-text me-2"></i>Books Inventory</h1>
    <a href="{{ route('books.create') }}" class="btn d-flex align-items-center shadow-sm text-white" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);">
        <i class="bi bi-plus-lg me-2"></i> Add New Book
    </a>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-3">
        <form action="{{ route('books.index') }}" method="GET" class="row g-3 align-items-center">
            <div class="col-md-4">
                <label class="form-label small fw-bold text-muted mb-1">Filter by Category</label>
                <select name="category" class="form-select form-select-sm shadow-none" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-bold text-muted mb-1">Filter by Author</label>
                <select name="author" class="form-select form-select-sm shadow-none" onchange="this.form.submit()">
                    <option value="">All Authors</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" {{ request('author') == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <a href="{{ route('books.index') }}" class="btn btn-sm btn-outline-secondary w-100 shadow-none"><i class="bi bi-x-circle me-1"></i> Clear Filters</a>
            </div>
        </form>
    </div>
</div>

<div class="card table-custom border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Book Details</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th class="text-center">Stock</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                    <tr>
                        <td class="ps-4 fw-semibold text-muted">#{{ str_pad($book->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-light text-primary rounded d-flex align-items-center justify-content-center me-3 shadow-sm border" style="width: 45px; height: 55px;">
                                    <i class="bi bi-book fs-4"></i>
                                </div>
                                <div>
                                    <span class="d-block fw-bold text-dark">{{ $book->title }}</span>
                                    <small class="text-muted">Added: {{ $book->created_at->format('M d, Y') }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-soft-primary text-primary rounded-pill px-3">{{ $book->category->name ?? 'Uncategorized' }}</span>
                        </td>
                        <td>
                            @if($book->author_id)
                                <a href="{{ route('authors.show', $book->author_id) }}" class="text-decoration-none fw-medium text-dark"><i class="bi bi-person me-1"></i> {{ $book->author->name ?? 'Unknown' }}</a>
                            @else
                                <span class="text-muted small"><i class="bi bi-person-x me-1"></i> Unknown</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($book->available_quantity > 0)
                                <span class="custom-badge bg-success bg-opacity-10 text-success border border-success"><i class="bi bi-check-circle-fill me-1"></i> {{ $book->available_quantity }} / {{ $book->total_quantity }}</span>
                            @else
                                <span class="custom-badge bg-danger bg-opacity-10 text-danger border border-danger"><i class="bi bi-x-circle-fill me-1"></i> {{ $book->available_quantity }} / {{ $book->total_quantity }}</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            @if(Auth::user()->role === 'user')
                                @if($book->available_quantity <= 0)
                                    <form action="{{ route('reservations.store') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                                        <button type="submit" class="btn btn-sm btn-warning rounded-pill px-3 shadow-sm border-0"><i class="bi bi-person-plus-fill me-1"></i> Reserve</button>
                                    </form>
                                @else
                                    <span class="badge bg-soft-success text-success border-0 px-3">Available</span>
                                @endif
                            @else
                                <div class="d-flex justify-content-end align-items-center">
                                    @if($book->reservations()->where('status', 'pending')->count() > 0)
                                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning rounded-pill px-2 me-2" title="Waitlist Count">
                                            <i class="bi bi-people-fill me-1"></i> {{ $book->reservations()->where('status', 'pending')->count() }}
                                        </span>
                                    @endif
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 shadow-sm me-1"><i class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirm deletion?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 shadow-sm"><i class="bi bi-trash3"></i></button>
                                    </form>
                                </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="bi bi-journal-x text-muted" style="font-size: 3rem;"></i>
                            <h5 class="mt-3 text-muted">No books in inventory</h5>
                            <p class="text-muted mb-0">Add your first book to populate the library database.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($books->hasPages())
    <div class="card-footer bg-white border-0 py-3">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
