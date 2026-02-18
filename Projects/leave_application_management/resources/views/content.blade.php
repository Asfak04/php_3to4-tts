@extends('layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Main Content -->
        <div class="container py-4">


            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold">Leave Requests</h3>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#applyLeaveModal">
                    <i class="bi bi-plus-lg"></i> Apply Leave
                </button>
            </div>
            @if(Session('success'))
            <div class="alert alert-success">
                <span>{{session('success')}}</span>
            </div>
            @endif
            @if(Session('del'))
            <div class="alert alert-success">
                <span>{{session('del')}}</span>
            </div>
            @endif
            <!-- Leave Table -->
            <div class="card shadow-sm">
                <div class="card-body">

                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Employee Name</th>
                                <th>Leave Type</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Reason</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach($leave as $leave)
                            <tr>
                                <td>{{$leave->id}}</td>
                                <td>{{$leave->employee_name}}</td>
                                <td>{{$leave->type}}</td>
                                <td>{{$leave->start_date}}</td>
                                <td>{{$leave->end_date}}</td>
                                <td>{{$leave->reason}}</td>

                                <td><span class="badge bg-warning">{{$leave->status}}</span></td>
                                <td class="text-center">
                                    <a href='{{asset("employee_show/".$leave->id)}}'> <button class="btn btn-sm btn-info"><i class="bi bi-eye"></i></button></a>
                                    <a href='{{asset("employee_edit/".$leave->id)}}'> <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button></a>
                                    <a href='{{asset("employee_delete/" . $leave->id)}}'><button class="btn btn-danger">Delete</button></a>

                                </td>
                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>
            </div>
            <!-- Apply Leave Modal -->
            <div class="modal fade" id="applyLeaveModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Apply Leave</h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <form method="POST">
                                @csrf

                                <!-- Employee Name -->
                                <div class="mb-3">
                                    <label class="form-label">Employee Name</label>
                                    <input type="text" name="employee_name" class="form-control @error('employee_name') is-invalid @enderror">
                                </div>
                                @error('employee_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <!-- Leave Type -->
                                <div class="mb-3">
                                    <label class="form-label">Leave Type</label>
                                    <select name="type" class="form-select @error('type') is-invalid @enderror">
                                        <option value="">Select Type</option>
                                        <option value="Sick">Sick</option>
                                        <option value="Casual">Casual</option>
                                        <option value="Vacation">Vacation</opton>
                                    </select>
                                </div>
                                @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <!-- Dates -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror">
                                    </div>
                                    @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class=" col-md-6 mb-3">
                                        <label class="form-label">End Date</label>
                                        <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror">
                                    </div>
                                    @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Reason -->
                                <div class="mb-3">
                                    <label class="form-label">Reason</label>
                                    <textarea name="reason" class="form-control @error('reason') is-invalid @enderror" rows="3"></textarea>
                                </div>
                                @error('reason')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <!-- Status (optional for admin) -->
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select @error('status') is-invalid @enderror">

                                        <option value="Pending">Pending</optio>
                                        <option value="Approved">Approved</opton>
                                        <option value="Rejected">Rejected</opton>
                                    </select>
                                </div>
                                @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <button type="submit" class="btn btn-primary">
                                    Submit Leave Request
                                </button>
                                <a href="" class="btn btn-secondary">Cancel</a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="deleteModal">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content text-center p-3">
                        <h5>Delete Request?</h5>
                        <p class="text-muted">This action cannot be undone.</p>
                        <div class="d-flex justify-content-center gap-2">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Logout</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                Are you sure you want to logout?
            </div>
            <div class="modal-footer justify-content-center">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="logout.html" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>
@endsection