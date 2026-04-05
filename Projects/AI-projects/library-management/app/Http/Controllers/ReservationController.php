<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\BookReservation;
use App\Models\Student;

class ReservationController extends Controller
{
    public function index()
    {
        $query = BookReservation::with(['student.user', 'book'])->latest();

        if (auth()->user()->role === 'user') {
            $student = auth()->user()->student;
            if ($student) {
                $query->where('student_id', $student->id);
            } else {
                $query->whereRaw('1 = 0');
            }
        }

        $reservations = $query->paginate(10);
        return view('reservations.index', compact('reservations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $student = auth()->user()->student;
        if (!$student) {
            return back()->with('error', 'Student profile not found.');
        }

        // Limit: 2 active reservations per student
        $activeReservationsCount = BookReservation::where('student_id', $student->id)
            ->whereIn('status', ['pending', 'ready'])
            ->count();

        if ($activeReservationsCount >= 2) {
            return back()->with('error', 'You can only have 2 active reservations at a time.');
        }

        // Check if already reserved
        $alreadyReserved = BookReservation::where('student_id', $student->id)
            ->where('book_id', $request->book_id)
            ->whereIn('status', ['pending', 'ready'])
            ->first();

        if ($alreadyReserved) {
            return back()->with('error', 'You have already reserved this book.');
        }

        // Check if student already has the book issued
        $alreadyIssued = \App\Models\BookIssue::where('student_id', $student->id)
            ->where('book_id', $request->book_id)
            ->where('status', 'issued')
            ->first();

        if ($alreadyIssued) {
            return back()->with('error', 'You already have this book issued.');
        }

        BookReservation::create([
            'student_id' => $student->id,
            'book_id' => $request->book_id,
            'status' => 'pending',
            'reserved_at' => now(),
        ]);

        return back()->with('success', 'Book reserved successfully! You are now in the waitlist.');
    }

    public function destroy(BookReservation $reservation)
    {
        if (auth()->user()->role !== 'admin' && $reservation->student_id !== auth()->user()->student->id) {
            abort(403);
        }

        if ($reservation->status === 'ready') {
            // If it was ready, we need to release the book back to inventory
            $reservation->book->increment('available_quantity');
        }

        $reservation->delete();
        return back()->with('success', 'Reservation cancelled.');
    }
}
