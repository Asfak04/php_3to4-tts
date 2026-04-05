<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookIssue;
use App\Models\Student;
use App\Models\BookReservation;
use Illuminate\Http\Request;

use App\Models\Fine;
use Carbon\Carbon;

class IssueController extends Controller
{
    public function index()
    {
        $query = BookIssue::with(['student.user', 'book', 'fine']);

        if (auth()->user()->role === 'user') {
            $student = auth()->user()->student;
            if ($student) {
                $query->where('student_id', $student->id);
            } else {
                $query->whereRaw('1 = 0');
            }
        }

        $issues = $query->latest()->paginate(10);
        
        // Stats for admin
        $pendingRenewalsCount = 0;
        if (auth()->user()->role === 'admin') {
            $pendingRenewalsCount = BookIssue::where('renewal_status', 'requested')->count();
        }

        return view('issues.index', compact('issues', 'pendingRenewalsCount'));
    }

    public function create()
    {
        $students = Student::all();
        
        // Books that are either in stock OR held by a 'ready' reservation
        $books = Book::where('available_quantity', '>', 0)
            ->orWhereHas('reservations', function($q) {
                $q->where('status', 'ready');
            })
            ->get();
            
        return view('issues.create', compact('students', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'book_id' => 'required|exists:books,id',
            'issue_date' => 'required|date',
        ]);

        $book = Book::find($request->book_id);

        // Check if this specific student has a 'ready' reservation
        $readyReservation = BookReservation::where('student_id', $request->student_id)
            ->where('book_id', $request->book_id)
            ->where('status', 'ready')
            ->first();

        if (!$readyReservation && $book->available_quantity <= 0) {
            return back()->with('error', 'Book is currently out of stock.');
        }

        // Prevent duplicate issue
        $existingIssue = BookIssue::where('student_id', $request->student_id)
            ->where('book_id', $request->book_id)
            ->where('status', 'issued')
            ->first();

        if ($existingIssue) {
            return back()->with('error', 'Student has already issued this book.');
        }

        // Cooldown Check
        $lastIssue = BookIssue::where('student_id', $request->student_id)
            ->where('book_id', $request->book_id)
            ->where('status', 'returned')
            ->orderBy('last_returned_at', 'desc')
            ->first();

        if ($lastIssue && $lastIssue->last_returned_at > now()->subMonth()) {
            $waitDays = now()->diffInDays(Carbon::parse($lastIssue->last_returned_at)->addMonth());
            return back()->with('error', "Cooldown active. Wait {$waitDays} more days.");
        }

        \DB::transaction(function () use ($request, $book, $readyReservation) {
            $issueDate = Carbon::parse($request->issue_date);
            BookIssue::create([
                'student_id' => $request->student_id,
                'book_id' => $request->book_id,
                'issue_date' => $request->issue_date,
                'due_date' => $issueDate->addMonth(),
                'status' => 'issued',
            ]);

            if ($readyReservation) {
                $readyReservation->update(['status' => 'fulfilled']);
            } else {
                $book->decrement('available_quantity');
            }
        });

        return redirect()->route('issues.index')->with('success', 'Book issued successfully.');
    }
    public function returnBook(BookIssue $issue)
    {
        if ($issue->status == 'returned') {
            return back()->with('error', 'Book is already returned.');
        }

        \DB::transaction(function () use ($issue) {
            $returnDate = now();
            $issue->update([
                'status' => 'returned',
                'return_date' => $returnDate,
                'last_returned_at' => $returnDate,
            ]);

            // Reservation Handshake: Check if anyone is waiting
            $pendingReservation = BookReservation::where('book_id', $issue->book_id)
                ->where('status', 'pending')
                ->orderBy('reserved_at', 'asc')
                ->first();

            if ($pendingReservation) {
                // Hold the book for this student (do not increment available_quantity)
                $pendingReservation->update([
                    'status' => 'ready',
                    'pickup_due_at' => now()->addDays(3)
                ]);
            } else {
                // No one is waiting, put back in stock
                $issue->book->increment('available_quantity');
            }

            // Fine Calculation
            $dueDate = Carbon::parse($issue->due_date);
            $graceDate = $dueDate->copy()->addDays(3);

            if ($returnDate->gt($graceDate)) {
                $daysOverdue = $returnDate->diffInDays($dueDate);
                $totalFine = $daysOverdue * 10;

                Fine::create([
                    'book_issue_id' => $issue->id,
                    'amount' => $totalFine,
                    'status' => 'unpaid'
                ]);
            }
        });

        return redirect()->route('issues.index')->with('success', 'Book returned successfully.');
    }

    public function requestRenewal(BookIssue $issue)
    {
        if ($issue->renewal_status !== 'none' || $issue->renewal_count >= 1) {
            return back()->with('error', 'Renewal already requested or limit reached.');
        }

        if (now()->gt(Carbon::parse($issue->due_date))) {
            return back()->with('error', 'Cannot request renewal for overdue books.');
        }

        $issue->update(['renewal_status' => 'requested']);
        return back()->with('success', 'Renewal request sent to admin.');
    }

    public function approveRenewal(BookIssue $issue)
    {
        if ($issue->renewal_count >= 1) {
            return back()->with('error', 'Renewal limit reached.');
        }

        $issue->update([
            'due_date' => Carbon::parse($issue->due_date)->addMonth(),
            'renewal_count' => $issue->renewal_count + 1,
            'renewal_status' => 'approved'
        ]);

        return back()->with('success', 'Renewal approved. Due date extended by 1 month.');
    }

    public function rejectRenewal(BookIssue $issue)
    {
        $issue->update(['renewal_status' => 'declined']);
        return back()->with('success', 'Renewal request declined.');
    }

    public function adminRenew(BookIssue $issue)
    {
        if ($issue->renewal_count >= 1) {
            return back()->with('error', 'Renewal limit reached.');
        }

        $issue->update([
            'due_date' => Carbon::parse($issue->due_date)->addMonth(),
            'renewal_count' => $issue->renewal_count + 1,
            'renewal_status' => 'approved'
        ]);

        return back()->with('success', 'Book renewed successfully by admin.');
    }
}
