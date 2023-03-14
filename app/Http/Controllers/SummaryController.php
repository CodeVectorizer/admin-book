<?php

namespace App\Http\Controllers;

use App\Models\Summary;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function index()
    {
        $summaries = Summary::all();
        return view('summaries.index', compact('summaries'));
    }

    public function create()
    {
        return view('summaries.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|integer',
            'book_id' => 'required|integer',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        Summary::create($validatedData);

        return redirect()->route('summaries.index')->with('success', 'Summary created successfully');
    }

    public function show($id)
    {
        $summary = Summary::findOrFail($id);
        return view('summaries.show', compact('summary'));
    }

    public function edit($id)
    {
        $summary = Summary::findOrFail($id);
        return view('summaries.edit', compact('summary'));
    }

    public function update(Request $request, $id)
    {
        $summary = Summary::findOrFail($id);

        $validatedData = $request->validate([
            'student_id' => 'required|integer',
            'book_id' => 'required|integer',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        $summary->update($validatedData);

        return redirect()->route('summaries.index')->with('success', 'Summary updated successfully');
    }
}
