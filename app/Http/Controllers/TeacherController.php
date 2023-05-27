<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $teachers = Teacher::with('user')->latest();
        if ($request->has('search') && $request->search != '') {
            $teachers = $teachers->where('nip', 'like', '%' . $request->search . '%')
                ->orWhereHas('user', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('email', 'like', '%' . $request->search . '%')
                        ->orWhere('nip', 'like', '%' . $request->search . '%')
                        ->orWhere('address', 'like', '%' . $request->search . '%');
                });
        }

        $teachers = $teachers->paginate(10);
        return view('teachers.index', ['teachers' => $teachers, 'type_menu' => 'teachers']);
    }

    public function create()
    {
        return view('teachers.create', ['type_menu' => 'teachers']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'nip' => 'required|unique:teachers,nip',
            'address' => 'required|string',
        ]);

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'teacher',
        ]);
        $user->save();

        $teacher = new Teacher([
            'user_id' => $user->id,
            'nip' => $request->input('nip'),
            'address' => $request->input('address'),
        ]);
        $teacher->save();

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully');
    }

    public function show(Teacher $teacher)
    {
        return view('teachers.show', ['teacher' => $teacher, 'type_menu' => 'teachers']);
    }

    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', ['teacher' => $teacher, 'type_menu' => 'teachers']);
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $teacher->user->id,
            'password' => 'nullable|min:6',
            'nip' => 'required|unique:teachers,nip,' . $teacher->id,
            'address' => 'required|string',
        ]);

        $teacher->user->name = $request->input('name');
        $teacher->user->email = $request->input('email');
        if ($request->input('password')) {
            $teacher->user->password = bcrypt($request->input('password'));
        }
        $teacher->user->save();

        $teacher->nip = $request->input('nip');
        $teacher->address = $request->input('address');
        $teacher->save();

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->user->delete();
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully');
    }
}
