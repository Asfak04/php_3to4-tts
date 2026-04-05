@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
    <h1 class="h3 page-title"><i class="bi bi-people me-2"></i>Students Directory</h1>
    <a href="{{ route('students.create') }}" class="btn btn-primary d-flex align-items-center shadow-sm">
        <i class="bi bi-plus-lg me-2"></i> Add New Student
    </a>
</div>

<div class="card table-custom border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                    <tr>
                        <td class="ps-4 fw-semibold text-muted">#{{ str_pad($student->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 40px; height: 40px; font-weight: 600;">
                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                </div>
                                <span class="fw-medium text-dark">{{ $student->name }}</span>
                            </div>
                        </td>
                        <td><a href="mailto:{{ $student->email }}" class="text-decoration-none text-muted"><i class="bi bi-envelope me-1"></i> {{ $student->email }}</a></td>
                        <td><span class="text-muted"><i class="bi bi-telephone me-1"></i> {{ $student->phone ?? 'Not Available' }}</span></td>
                        <td class="text-end pe-4">
                            <a href="{{ route('students.reset-password', $student->id) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3 shadow-sm me-1" title="Reset Password"><i class="bi bi-key-fill"></i></a>
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 shadow-sm me-1"><i class="bi bi-pencil-square"></i></a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete {{ $student->name }} permanently?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 shadow-sm"><i class="bi bi-trash3"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="bi bi-people text-muted" style="font-size: 3rem;"></i>
                            <h5 class="mt-3 text-muted">No students found</h5>
                            <p class="text-muted mb-0">Get started by adding a new student to the system.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($students->hasPages())
    <div class="card-footer bg-white border-0 py-3">
        {{ $students->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
