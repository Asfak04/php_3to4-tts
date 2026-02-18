@extends('layout')
@section('content')
<div class="d-flex justify-content-end pb-2">
    <a href="/" class="btn btn-secondary ">Cancel</a>
</div>
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
                </tr>
            </thead>


            <tbody>
                <tr>
                    <td>{{$showEmployee->id}}</td>
                    <td>{{$showEmployee->employee_name}}</td>
                    <td>{{$showEmployee->type}}</td>
                    <td>{{$showEmployee->start_date}}</td>
                    <td>{{$showEmployee->end_date}}</td>
                    <td>{{$showEmployee->reason}}</td>

                    <td><span class="badge bg-warning">{{$showEmployee->status}}</span></td>
                </tr>


            </tbody>

        </table>

    </div>
</div>
@endsection