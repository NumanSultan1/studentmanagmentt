<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // List all students (with search + pagination)
    public function index(Request $request)
    {
        $query = Student::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        $students = $query->latest()->paginate(10);
        return view('students.index', compact('students'));
    }

    // Show create form
    public function create()
    {
        return view('students.create');
    }

    // Save new student
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:students,email',
            'phone'   => 'nullable|numeric',
            'address' => 'nullable|string',
        ]);

        Student::create($request->only('name', 'email', 'phone', 'address'));

        return redirect()->route('students.index')
                         ->with('success', 'Student added successfully!');
    }

    // Show edit form
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    // Update student
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:students,email,' . $student->id,
            'phone'   => 'nullable|numeric',
            'address' => 'nullable|string',
        ]);

        $student->update($request->only('name', 'email', 'phone', 'address'));

        return redirect()->route('students.index')
                         ->with('success', 'Student updated successfully!');
    }

    // Delete student
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')
                         ->with('success', 'Student deleted successfully!');
    }
}