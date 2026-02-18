@extends('layout')
@section('content')
<div class="container-fluid">
    <form method="POST">
        @csrf
        <!-- Employee Name -->
        <div class="mb-3">
            <label class="form-label">Employee Name</label>
            <input type="text" value="{{$edit->employee_name}}" name="employee_name" class="form-control @error('employee_name') is-invalid @enderror">
        </div>
        @error('employee_name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <!-- Leave Type -->
        <div class="mb-3">
            <label class="form-label">Leave Type</label>
            <select name="type" value="{{$edit->type}}" class="form-select @error('type') is-invalid @enderror">
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
                <input type="date" value="{{$edit->start_date}}" name="start_date" class="form-control @error('start_date') is-invalid @enderror">
            </div>
            @error('start_date')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class=" col-md-6 mb-3">
                <label class="form-label">End Date</label>
                <input type="date" value="{{$edit->end_date}}" name="end_date" class="form-control @error('end_date') is-invalid @enderror">
            </div>
            @error('end_date')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Reason -->
        <div class="mb-3">
            <label class="form-label">Reason</label>
            <textarea name="reason" class="form-control @error('reason') is-invalid @enderror" rows="3">{{$edit->reason}}</textarea>
        </div>
        @error('reason')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Status (optional for admin) -->
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" value="{{$edit->status}}" class="form-select @error('status') is-invalid @enderror">

                <option value="Pending">Pending</optio>
                <option value="Approved">Approved</opton>
                <option value="Rejected">Rejected</opton>
            </select>
        </div>
        @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">
            Update Leave Request
        </button>
        <a href="/" class="btn btn-secondary">Cancel</a>

    </form>
</div>
@endsection