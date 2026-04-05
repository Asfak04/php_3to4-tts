<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students',
            'phone' => 'nullable|string|max:20',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]);

            Student::create(array_merge($request->all(), ['user_id' => $user->id]));
        });

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'nullable|string|max:20',
        ]);

        DB::transaction(function () use ($request, $student) {
            $student->update($request->all());
            if ($student->user) {
                $student->user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
            }
        });

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $user = $student->user;
        $student->delete();
        if ($user) {
            $user->delete();
        }
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }

    public function showResetPasswordForm(Student $student)
    {
        return view('students.reset-password', compact('student'));
    }

    public function resetPassword(Request $request, Student $student)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        if ($student->user) {
            $student->user->update([
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('students.index')->with('success', 'Password for ' . $student->name . ' has been updated successfully.');
        }

        return redirect()->route('students.index')->with('error', 'No user account found for this student.');
    }
}
