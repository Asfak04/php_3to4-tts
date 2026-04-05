@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
    <h1 class="h3 page-title"><i class="bi bi-grid-1x2 me-2"></i>Dashboard</h1>
</div>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card text-white border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%); border-radius: 12px;">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-uppercase fw-semibold mb-2" style="letter-spacing: 0.5px; font-size: 0.8rem;">Students</h6>
                    <h2 class="mb-0 fw-bold">{{ $totalStudents }}</h2>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: rgba(255,255,255,0.2);">
                    <i class="bi bi-people fs-3"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 12px;">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-uppercase fw-semibold mb-2" style="letter-spacing: 0.5px; font-size: 0.8rem;">Total Books</h6>
                    <h2 class="mb-0 fw-bold">{{ $totalBooks }}</h2>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: rgba(255,255,255,0.2);">
                    <i class="bi bi-journals fs-3"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 12px;">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-uppercase fw-semibold mb-2" style="letter-spacing: 0.5px; font-size: 0.8rem;">Available</h6>
                    <h2 class="mb-0 fw-bold">{{ $availableBooks }}</h2>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: rgba(255,255,255,0.2);">
                    <i class="bi bi-check-circle fs-3"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-white border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px;">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-uppercase fw-semibold mb-2" style="letter-spacing: 0.5px; font-size: 0.8rem;">Current Issues</h6>
                    <h2 class="mb-0 fw-bold">{{ $issuedBooks }}</h2>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: rgba(255,255,255,0.2);">
                    <i class="bi bi-bookmark-dash fs-3"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card bg-white border-0 shadow-sm border-start border-danger border-5 h-100">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="me-3 p-3 bg-danger bg-opacity-10 text-danger rounded">
                    <i class="bi bi-exclamation-triangle fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted text-uppercase small fw-bold mb-1">Overdue</h6>
                    <h3 class="mb-0 fw-bold text-danger">{{ $overdueBooks }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card bg-white border-0 shadow-sm border-start border-warning border-5 h-100">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="me-3 p-3 bg-warning bg-opacity-10 text-warning rounded">
                    <i class="bi bi-currency-dollar fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted text-uppercase small fw-bold mb-1">Unpaid Fines</h6>
                    <h3 class="mb-0 fw-bold text-warning">{{ number_format($totalUnpaidFines, 2) }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card bg-white border-0 shadow-sm border-start border-info border-5 h-100">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="me-3 p-3 bg-info bg-opacity-10 text-info rounded">
                    <i class="bi bi-clock-history fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted text-uppercase small fw-bold mb-1">Renewals</h6>
                    <h3 class="mb-0 fw-bold text-info">{{ $pendingRenewals }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card bg-white border-0 shadow-sm border-start border-success border-5 h-100">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="me-3 p-3 bg-success bg-opacity-10 text-success rounded">
                    <i class="bi bi-person-check fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted text-uppercase small fw-bold mb-1">Ready Pickup</h6>
                    <h3 class="mb-0 fw-bold text-success">{{ $readyReservations }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

@if($readyReservations > 0 && Auth::user()->role === 'admin')
<div class="alert alert-success border-0 shadow-sm d-flex align-items-center mb-4 py-3">
    <i class="bi bi-megaphone-fill fs-4 me-3"></i>
    <div class="flex-grow-1">
        <strong>Action Needed:</strong> There are <strong>{{ $readyReservations }}</strong> books waiting for students to pick them up.
    </div>
    <a href="{{ route('reservations.index') }}" class="btn btn-sm btn-success rounded-pill px-4">Manage Reservations</a>
</div>
@endif

<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm text-white" style="background: linear-gradient(135deg, #2c3e50 0%, #000000 100%); border-radius: 12px;">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="p-3 bg-white bg-opacity-25 rounded me-4">
                        <i class="bi bi-people-fill fs-2"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 fw-bold">Global Waitlist</h4>
                        <p class="mb-0 text-white-50">Currently, <strong>{{ $waitlistTotal }}</strong> books are being tracked in the reservation system.</p>
                    </div>
                </div>
                <div class="text-end">
                    <h1 class="display-4 fw-bold mb-0">{{ $waitlistTotal }}</h1>
                    <span class="text-uppercase small" style="letter-spacing: 2px;">Students Waiting</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 text-center text-muted">
                <i class="bi bi-stars fs-1 mb-3 text-warning"></i>
                <h5>Welcome to the Library Management System Dashboard</h5>
                <p>Use the navigation panel on the left to seamlessly manage students, inventory, and book issues.</p>
            </div>
        </div>
    </div>
</div>
@endsection
