@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
    <h1 class="h3 page-title"><i class="bi bi-person-plus me-2"></i>Book Waitlist & Reservations</h1>
</div>

<div class="row">
    <div class="col-12">
        <div class="card table-custom border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">No.</th>
                                <th>Student</th>
                                <th>Book Title</th>
                                <th>Status</th>
                                <th class="text-center">Reserved At</th>
                                <th class="text-center">Pickup Deadline</th>
                                <th class="text-end pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reservations as $reservation)
                            <tr class="{{ $reservation->status === 'ready' ? 'bg-soft-success' : '' }}">
                                <td class="ps-4 text-muted small">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $reservation->student->name ?? 'N/A' }}</div>
                                    <small class="text-muted">ID: {{ $reservation->student_id }}</small>
                                </td>
                                <td>
                                    <div class="text-dark"><i class="bi bi-book me-1 text-primary"></i> {{ $reservation->book->title ?? 'N/A' }}</div>
                                </td>
                                <td>
                                    @if($reservation->status == 'pending')
                                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning rounded-pill px-3"><i class="bi bi-clock me-1"></i> Waiting in Queue</span>
                                    @elseif($reservation->status == 'ready')
                                        <span class="badge bg-success text-white rounded-pill px-3 shadow-sm animate-pulse"><i class="bi bi-check-circle me-1"></i> Ready for Pickup</span>
                                    @elseif($reservation->status == 'fulfilled')
                                        <span class="badge bg-info bg-opacity-10 text-info border border-info rounded-pill px-3">Fulfilled</span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary rounded-pill px-3">Cancelled</span>
                                    @endif
                                </td>
                                <td class="text-center text-muted small">
                                    {{ $reservation->created_at->format('M d, Y') }}
                                </td>
                                <td class="text-center">
                                    @if($reservation->pickup_due_at)
                                        <span class="text-danger fw-bold">{{ \Carbon\Carbon::parse($reservation->pickup_due_at)->format('M d, H:i') }}</span>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    @if($reservation->status == 'pending' || $reservation->status == 'ready')
                                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Cancel this reservation?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                <i class="bi bi-x-circle me-1"></i> Cancel
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-sm btn-light disabled rounded-pill px-3 border" disabled>Closed</button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="bi bi-people text-muted" style="font-size: 3rem;"></i>
                                    <h5 class="mt-3 text-muted">No reservations at the moment</h5>
                                    <p class="text-muted mb-0">When students reserve out-of-stock books, they will appear here.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($reservations->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $reservations->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
