<?php

namespace App\Http\Controllers;

use App\Models\Summary;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function index()
    {
        $summaries = Summary::all();
        return view('summaries.index', ['summaries' => $summaries, 'type_menu' => 'summaries']);
    }

    public function create()
    {
        return view('summaries.create', ['type_menu' => 'summaries']);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|string',
        ]);

        $summary = new Summary();
        $summary->student_id = 1;
        $summary->book_id = 1;
        $summary->content = $validatedData['content'];
        $summary->status = 'need_review';

        $summary->save();

        return redirect()->route('summaries.index')->with('success', 'Summary created successfully');
    }

    public function show($id)
    {
        $summary = Summary::findOrFail($id);
        return view('summaries.show', ['summary' => $summary, 'type_menu' => 'summaries']);
    }

    public function edit($id)
    {
        $summary = Summary::findOrFail($id);
        return view('summaries.edit', ['summary' => $summary, 'type_menu' => 'summaries']);
    }

    public function update(Request $request, $id)
    {
        $summary = Summary::findOrFail($id);

        $validatedData = $request->validate([
            'student_id' => 'required|integer',
            'book_id' => 'required|integer',
            'content' => 'required|string',
            'status' => 'required|in:draft,need_review,published',
        ]);

        $summary->student_id = $validatedData['student_id'];
        $summary->book_id = $validatedData['book_id'];
        $summary->content = $validatedData['content'];

        $summary->save();


        return redirect()->route('summaries.index')->with('success', 'Summary updated successfully');
    }
}
