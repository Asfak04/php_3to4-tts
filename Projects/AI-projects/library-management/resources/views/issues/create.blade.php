@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4 pb-2">
    <h1 class="h3 page-title"><i class="bi bi-bookmark-plus me-2"></i>Initiate Book Assignment</h1>
    <a href="{{ route('issues.index') }}" class="btn btn-outline-secondary d-flex align-items-center bg-white shadow-sm border-0">
        <i class="bi bi-arrow-left me-2"></i> Back to Ledger
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-9 col-lg-8">
        <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold mb-0 text-dark">Checkout Registration</h5>
                <p class="text-muted small">Select the student profile and the physical book they are taking.</p>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('issues.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-floating mb-4 position-relative">
                        <select class="form-select bg-light border-0 shadow-none @error('student_id') is-invalid @enderror" id="student_id" name="student_id" required style="border-bottom: 2px solid #e9ecef !important; border-radius: 8px 8px 0 0;">
                            <option value="" disabled selected>-- Select an enrolled student --</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                    #{{ str_pad($student->id, 4, '0', STR_PAD_LEFT) }} - {{ $student->name }} ({{ $student->email }})
                                </option>
                            @endforeach
                        </select>
                        <label for="student_id" class="text-muted"><i class="bi bi-person-badge me-2"></i>Student Profiler</label>
                        @error('student_id') <div class="invalid-feedback position-absolute">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-floating mb-4 position-relative">
                        <select class="form-select bg-light border-0 shadow-none @error('book_id') is-invalid @enderror" id="book_id" name="book_id" required style="border-bottom: 2px solid #e9ecef !important; border-radius: 8px 8px 0 0;">
                            <option value="" disabled selected>-- Select an available publication --</option>
                            @foreach($books as $book)
                                @php
                                    $readyRes = $book->reservations->where('status', 'ready')->first();
                                    $label = $book->title;
                                    if ($readyRes) {
                                        $label .= " [RESERVED for " . ($readyRes->student->name ?? 'Student'). "]";
                                    }
                                @endphp
                                <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                    {{ $label }} (Copies: {{ $book->available_quantity }})
                                </option>
                            @endforeach
                        </select>
                        <label for="book_id" class="text-muted"><i class="bi bi-journal-code me-2"></i>Inventory Selection</label>
                        @error('book_id') <div class="invalid-feedback position-absolute">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-floating mb-5 position-relative">
                        <input type="date" class="form-control bg-light border-0 shadow-none @error('issue_date') is-invalid @enderror" id="issue_date" name="issue_date" value="{{ old('issue_date', date('Y-m-d')) }}" required style="border-bottom: 2px solid #e9ecef !important; border-radius: 8px 8px 0 0;">
                        <label for="issue_date" class="text-muted"><i class="bi bi-calendar-day me-2"></i>Assigned Date / Checkout Timestamp</label>
                        @error('issue_date') <div class="invalid-feedback position-absolute">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-grid mt-2">
                        <button type="submit" class="btn btn-primary py-3 shadow-sm border-0" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); border-radius: 8px; font-weight: 600; letter-spacing: 0.5px;">
                            <i class="bi bi-box-arrow-right me-2 fs-5"></i> Finalize Assignment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
