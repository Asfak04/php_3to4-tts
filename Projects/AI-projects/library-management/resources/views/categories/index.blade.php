@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
    <h1 class="h3 page-title"><i class="bi bi-tags me-2"></i>Book Categories</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary d-flex align-items-center shadow-sm">
        <i class="bi bi-plus-lg me-2"></i> Add New Category
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
                                <th class="ps-4">ID</th>
                                <th>Category Name</th>
                                <th>Slug</th>
                                <th class="text-center">Total Books</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                            <tr>
                                <td class="ps-4 fw-semibold text-muted">#{{ str_pad($category->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td>
                                    <span class="fw-medium text-dark">{{ $category->name }}</span>
                                </td>
                                <td><code class="text-muted">{{ $category->slug }}</code></td>
                                <td class="text-center">
                                    <span class="badge bg-soft-primary text-primary rounded-pill px-3">{{ $category->books_count }} Books</span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 shadow-sm me-1"><i class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete category? This might leave books without a category.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 shadow-sm"><i class="bi bi-trash3"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="bi bi-tags text-muted" style="font-size: 3rem;"></i>
                                    <h5 class="mt-3 text-muted">No categories found</h5>
                                    <p class="text-muted mb-0">Start by adding library genres or book categories.</p>
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
