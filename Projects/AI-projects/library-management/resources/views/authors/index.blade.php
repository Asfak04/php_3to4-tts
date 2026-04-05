@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
    <h1 class="h3 page-title"><i class="bi bi-vector-pen me-2"></i>Authors Profiles</h1>
    <a href="{{ route('authors.create') }}" class="btn btn-primary d-flex align-items-center shadow-sm">
        <i class="bi bi-plus-lg me-2"></i> Add New Author
    </a>
</div>

<div class="row">
    <div class="col-12">
        <div class="card table-custom border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Author</th>
                                <th>Biography</th>
                                <th class="text-center">Total Books</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($authors as $author)
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center">
                                        @if($author->photo_url)
                                            <img src="{{ $author->photo_url }}" class="rounded-circle me-3 shadow-sm border border-2 border-white" style="width: 45px; height: 45px; object-fit: cover;" alt="{{ $author->name }}">
                                        @else
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm border border-2 border-white" style="width: 45px; height: 45px; font-weight: 600;">
                                                {{ strtoupper(substr($author->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <h6 class="mb-0 fw-bold">{{ $author->name }}</h6>
                                            <small class="text-muted"><i class="bi bi-book me-1"></i> Library Contributor</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-muted small text-truncate-2" style="max-width: 300px;">
                                        {{ Str::limit($author->bio, 80) ?? 'No biography provided yet.' }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-soft-info text-info rounded-pill px-3">{{ $author->books_count }} Titles</span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('authors.show', $author->id) }}" class="btn btn-sm btn-outline-info rounded-pill px-3 shadow-sm me-1" title="View Profile"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 shadow-sm me-1" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('authors.destroy', $author->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete author profile?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 shadow-sm" title="Delete"><i class="bi bi-trash3"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <i class="bi bi-person-badge text-muted" style="font-size: 3rem;"></i>
                                    <h5 class="mt-3 text-muted">No authors listed</h5>
                                    <p class="text-muted mb-0">Add authors to link them with their publications.</p>
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
