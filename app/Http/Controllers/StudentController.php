<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Student;

class StudentController extends Controller
{

    public function index()
    {
        $students = Student::with('user')->get();
        return view('students.index', ['students' => $students, 'type_menu' => 'students']);
    }

    public function create()
    {
        return view('students.create', ['type_menu' => 'students']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'nik' => 'required|unique:students,nik',
            'class' => 'required|string',
            'major' => 'required|string',
            'address' => 'required|string',
        ]);

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'student',
        ]);
        $user->save();

        $student = new Student([
            'user_id' => $user->id,
            'nik' => $request->input('nik'),
            'class' => $request->input('class'),
            'major' => $request->input('major'),
            'address' => $request->input('address'),
            'point' => 0,
        ]);
        $student->save();

        return redirect()->route('students.index')->with('success', 'Student created successfully');
    }

    public function show(Student $student)
    {
        return;
        return view('students.show', ['student' => $student, 'type_menu' => 'students']);
    }

    public function edit(Student $student)
    {
        return view('students.edit', ['student' => $student, 'type_menu' => 'students']);
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $student->user_id,
            'nik' => 'required|unique:students,nik,' . $student->id,
            'class' => 'required|string',
            'major' => 'required|string',
            'address' => 'required|string',
        ]);

        $user = User::find($student->user_id);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $student->update([
            'nik' => $request->input('nik'),
            'class' => $request->input('class'),
            'major' => $request->input('major'),
            'address' => $request->input('address'),
        ]);

        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    public function destroy(Student $student)
    {
        $user = User::find($student->user_id);
        $user->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }

    public function resetPoint()
    {
        Student::query()->update(['point' => 0]);

        return redirect()->route('students.index')->with('success', 'Point reset successfully');
    }
}
