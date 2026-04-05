@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
    <h1 class="h3 page-title"><i class="bi bi-cash-stack me-2"></i>Penalties & Fines</h1>
    @if(Auth::user()->role === 'admin')
    <div class="text-muted small">
        <i class="bi bi-info-circle me-1"></i> Managing unpaid fines for all students.
    </div>
    @endif
</div>

<div class="row">
    <div class="col-12">
        <div class="card table-custom border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Fine ID</th>
                                <th>Student</th>
                                <th>Book Title</th>
                                <th>Amount</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Issued On</th>
                                <th class="text-end pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($fines as $fine)
                            <tr>
                                <td class="ps-4 fw-semibold text-muted">#FN-{{ str_pad($fine->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td>
                                    <div class="fw-medium text-dark">{{ $fine->bookIssue->student->name ?? 'N/A' }}</div>
                                    <small class="text-muted">ID: {{ $fine->bookIssue->student_id }}</small>
                                </td>
                                <td>
                                    <div class="text-dark">{{ $fine->bookIssue->book->title ?? 'N/A' }}</div>
                                </td>
                                <td class="fw-bold text-danger">10 x {{ number_format($fine->amount / 10, 0) }} Days = {{ $fine->amount }}</td>
                                <td class="text-center">
                                    @if($fine->status == 'unpaid')
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger rounded-pill px-3">Unpaid</span>
                                    @else
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success rounded-pill px-3">Paid</span>
                                        <div class="small text-muted mt-1">{{ \Carbon\Carbon::parse($fine->paid_at)->format('M d, Y') }}</div>
                                    @endif
                                </td>
                                <td class="text-center text-muted small">
                                    {{ $fine->created_at->format('M d, Y') }}
                                </td>
                                <td class="text-end pe-4">
                                    @if($fine->status == 'unpaid' && Auth::user()->role === 'admin')
                                        <form action="{{ route('fines.pay', $fine->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm border-0">
                                                <i class="bi bi-check-circle me-1"></i> Mark Paid
                                            </button>
                                        </form>
                                    @elseif(Auth::user()->role === 'admin')
                                        <form action="{{ route('fines.destroy', $fine->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this fine record?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill px-3 border-0">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted small">Please visit Admin to pay.</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="bi bi-shield-check text-muted" style="font-size: 3rem;"></i>
                                    <h5 class="mt-3 text-muted">No fines recorded</h5>
                                    <p class="text-muted mb-0">Clean slate! There are no outstanding penalties.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($fines->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $fines->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
