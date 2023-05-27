<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index($id)
    {
        $students = Student::with('user')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Student',
            'data' => $students
        ], 200);
    }

    public function show($id)
    {
        $student = Student::where('id', $id)->with('user')->first();
        // $student = Student::find($id)->with('user')->first();
        // dd($student);

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Student',
            'data' => $student
        ], 200);
    }
}
