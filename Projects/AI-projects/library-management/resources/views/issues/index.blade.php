@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
    <h1 class="h3 page-title"><i class="bi bi-bookmark-check me-2"></i>Active Issues Ledger</h1>
    @if(Auth::check() && Auth::user()->role === 'admin')
    <a href="{{ route('issues.create') }}" class="btn d-flex align-items-center shadow-sm text-white" style="background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%); border: none;">
        <i class="bi bi-bookmark-plus me-2"></i> Issue New Book
    </a>
    @endif
</div>

@if($pendingRenewalsCount > 0 && Auth::user()->role === 'admin')
<div class="alert alert-info border-0 shadow-sm d-flex align-items-center mb-4">
    <i class="bi bi-info-circle-fill fs-4 me-3"></i>
    <div>
        <strong>Pending Action:</strong> You have <strong>{{ $pendingRenewalsCount }}</strong> new renewal requests waiting for your approval.
    </div>
</div>
@endif

<div class="card table-custom border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">TRX ID</th>
                        <th>Student & Book</th>
                        <th>Dates</th>
                        <th>Due Date</th>
                        <th class="text-center">Status</th>
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($issues as $issue)
                    @php
                        $isOverdue = $issue->status === 'issued' && \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($issue->due_date));
                        $daysOverdue = $isOverdue ? \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($issue->due_date)) : 0;
                    @endphp
                    <tr class="{{ $isOverdue ? 'bg-soft-danger' : '' }}">
                        <td class="ps-4 fw-semibold text-muted">#{{ str_pad($issue->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-light text-primary rounded me-3 d-flex align-items-center justify-content-center border" style="width: 40px; height: 50px;">
                                    <i class="bi bi-journal-text fs-5"></i>
                                </div>
                                <div>
                                    <span class="d-block fw-bold text-dark mb-0">{{ $issue->book->title ?? 'Deleted Book' }}</span>
                                    <small class="text-muted"><i class="bi bi-person me-1"></i>{{ $issue->student->name ?? 'Deleted Student' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="small">
                                <div class="text-muted mb-1"><i class="bi bi-calendar-check me-1"></i> Issued: {{ \Carbon\Carbon::parse($issue->issue_date)->format('M d') }}</div>
                                @if($issue->return_date)
                                    <div class="text-success"><i class="bi bi-calendar-x me-1"></i> Returned: {{ \Carbon\Carbon::parse($issue->return_date)->format('M d') }}</div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="fw-medium {{ $isOverdue ? 'text-danger fw-bold' : 'text-dark' }}">
                                {{ \Carbon\Carbon::parse($issue->due_date)->format('M d, Y') }}
                                @if($isOverdue)
                                    <br><small class="badge bg-danger rounded-pill px-2" style="font-size: 0.7rem;">{{ $daysOverdue }} Days Overdue</small>
                                @endif
                                @if($issue->renewal_count > 0)
                                    <br><small class="text-info" style="font-size: 0.7rem;"><i class="bi bi-arrow-repeat me-1"></i> Renewed Once</small>
                                @endif
                            </div>
                        </td>
                        <td class="text-center">
                            @if($issue->status == 'issued')
                                @if($issue->renewal_status == 'requested')
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info rounded-pill px-3"><i class="bi bi-clock-history me-1"></i> Renewal Pending</span>
                                @elseif($isOverdue)
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger rounded-pill px-3"><i class="bi bi-exclamation-triangle me-1"></i> Overdue</span>
                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning rounded-pill px-3"><i class="bi bi-hourglass-split me-1"></i> Active</span>
                                @endif
                            @else
                                <span class="badge bg-success bg-opacity-10 text-success border border-success rounded-pill px-3"><i class="bi bi-check-all me-1"></i> Completed</span>
                            @if($issue->fine)
                                <div class="mt-1 small fw-bold {{ $issue->fine->status == 'paid' ? 'text-success' : 'text-danger' }}">
                                    Fine: {{ $issue->fine->amount }} ({{ ucfirst($issue->fine->status) }})
                                </div>
                            @endif
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            @if(Auth::user()->role === 'admin')
                                @if($issue->status == 'issued')
                                    <div class="btn-group shadow-sm">
                                        <form action="{{ route('issues.return', $issue->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success px-3 border-0 rounded-start"><i class="bi bi-arrow-return-right me-1"></i> Return</button>
                                        </form>
                                        
                                        @if($issue->renewal_count < 1)
                                            <button type="button" class="btn btn-sm btn-primary border-0 rounded-end dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                                <span class="visually-hidden">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                                @if($issue->renewal_status == 'requested')
                                                    <li>
                                                        <form action="{{ route('issues.approve-renewal', $issue->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item"><i class="bi bi-check-lg text-success me-2"></i> Approve Renewal</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('issues.reject-renewal', $issue->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item"><i class="bi bi-x-lg text-danger me-2"></i> Reject Request</button>
                                                        </form>
                                                    </li>
                                                @else
                                                    <li>
                                                        <form action="{{ route('issues.admin-renew', $issue->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item"><i class="bi bi-arrow-repeat text-primary me-2"></i> Quick Renew (1M)</button>
                                                        </form>
                                                    </li>
                                                @endif
                                            </ul>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-muted small"><i class="bi bi-lock-fill"></i> Closed</span>
                                @endif
                            @else
                                {{-- Student Actions --}}
                                @if($issue->status == 'issued')
                                    @if($issue->renewal_status == 'none' && $issue->renewal_count < 1 && !$isOverdue)
                                        <form action="{{ route('issues.request-renewal', $issue->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-primary rounded-pill px-3"><i class="bi bi-arrow-repeat me-1"></i> Request Renewal</button>
                                        </form>
                                    @elseif($issue->renewal_status == 'requested')
                                        <span class="text-muted small animate-pulse">Waiting for Admin...</span>
                                    @elseif($issue->renewal_status == 'approved')
                                        <span class="badge bg-soft-success text-success border-0 px-3">Renewed</span>
                                    @elseif($isOverdue)
                                        <span class="text-danger small fw-bold">Return immediately!</span>
                                    @endif
                                @else
                                    <span class="badge bg-soft-secondary text-secondary border-0 px-3">Archived</span>
                                @endif
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="bi bi-journal-bookmark text-muted" style="font-size: 3rem;"></i>
                            <h5 class="mt-3 text-muted">No transactions recorded</h5>
                            <p class="text-muted mb-0">Your book issues will appear here.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($issues->hasPages())
    <div class="card-footer bg-white border-0 py-3">
        {{ $issues->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
