<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Summary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SummaryController extends Controller
{
    public function index()
    {
        $summaries = Summary::latest()->get();
        $summaries->map(
            function ($summary) {
                $summary->book = $summary->book;
                $summary->book->cover = env('APP_URL') . Storage::url('books/' . $summary->book->cover);
                return $summary;
            }
        );
        return response()->json([
            'success' => true,
            'message' => 'List data Summary',
            'data'    => $summaries
        ], 200);
    }

    public function show($id)
    {
        $summary = Summary::find($id);
        $summary->book = $summary->book;
        $summary->book->cover = env('APP_URL') . Storage::url('books/' . $summary->book->cover);

        if (!$summary) {
            return response()->json([
                'success' => false,
                'message' => 'Summary not found',
                'data'    => null
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data Summary',
            'data'    => $summary
        ], 200);
    }

    public function store(Request $request)
    {

        $validateData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'book_id' => 'required|exists:books,id',
            'content' => 'required|max:255',
        ]);

        $summary = new Summary();

        $summary->fill($validateData);
        $summary->status = 'Need Review';

        $summary->save();

        return response()->json([
            'success' => true,
            'message' => 'Summary created successfully',
            'data'    => $summary
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $summary = Summary::find($id);

        if (!$summary) {
            return response()->json([
                'success' => false,
                'message' => 'Summary not found',
                'data'    => null
            ], 400);
        }

        $validateData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'book_id' => 'required|exists:books,id',
            'content' => 'required|max:255',
            'status' => 'required|max:255',
        ]);

        $summary->fill($validateData);

        $summary->save();

        return response()->json([
            'success' => true,
            'message' => 'Summary updated successfully',
            'data'    => $summary
        ], 200);
    }

    public function destroy($id)
    {
        $summary = Summary::find($id);

        if (!$summary) {
            return response()->json([
                'success' => false,
                'message' => 'Summary not found',
                'data'    => null
            ], 400);
        }

        $summary->delete();

        return response()->json([
            'success' => true,
            'message' => 'Summary deleted successfully',
            'data'    => null
        ], 200);
    }
}
