<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Fine;

class FineController extends Controller
{
    public function index()
    {
        $query = Fine::with(['bookIssue.student', 'bookIssue.book'])->latest();

        if (auth()->user()->role === 'user') {
            $student = auth()->user()->student;
            if ($student) {
                $query->whereHas('bookIssue', function($q) use ($student) {
                    $q->where('student_id', $student->id);
                });
            } else {
                $query->whereRaw('1 = 0');
            }
        }

        $fines = $query->paginate(10);
        return view('fines.index', compact('fines'));
    }

    public function markAsPaid(Fine $fine)
    {
        $fine->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        return back()->with('success', 'Fine marked as paid successfully.');
    }

    public function destroy(Fine $fine)
    {
        $fine->delete();
        return redirect()->route('fines.index')->with('success', 'Fine record deleted.');
    }
}
