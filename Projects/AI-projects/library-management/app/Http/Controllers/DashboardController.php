<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookIssue;
use App\Models\Student;
use App\Models\BookReservation;
use Illuminate\Http\Request;

use App\Models\Fine;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'user') {
            return redirect()->route('issues.index');
        }

        $totalStudents = Student::count();
        $totalBooks = Book::sum('total_quantity');
        $availableBooks = Book::sum('available_quantity');
        $issuedBooks = BookIssue::where('status', 'issued')->count();
        
        $overdueBooks = BookIssue::where('status', 'issued')
            ->where('due_date', '<', Carbon::now())
            ->count();
            
        $totalUnpaidFines = Fine::where('status', 'unpaid')->sum('amount');
        $pendingRenewals = BookIssue::where('renewal_status', 'requested')->count();
        
        $readyReservations = BookReservation::where('status', 'ready')->count();
        $waitlistTotal = BookReservation::where('status', 'pending')->count();

        return view('dashboard', compact(
            'totalStudents', 
            'totalBooks', 
            'availableBooks', 
            'issuedBooks', 
            'overdueBooks', 
            'totalUnpaidFines',
            'pendingRenewals',
            'readyReservations',
            'waitlistTotal'
        ));
    }
}
