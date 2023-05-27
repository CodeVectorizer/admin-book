<?php

namespace App\Http\Controllers;

use App\Models\Summary;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function index(Request $request)
    {
        $summaries = Summary::latest();
        if ($request->has('search') && $request->search != null) {
            $summaries = $summaries->whereHas(
                'user',
                function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('title', 'like', '%' . request()->search . '%')
                        ->orWhere('content', 'like', '%' . request()->search . '%')
                        ->orWhere('status', 'like', '%' . request()->search . '%');
                }
            );
        }
        $summaries = $summaries->paginate(10);
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
            'book_id' => 'required|integer',
        ]);

        $summary = new Summary();
        $summary->student_id = 1;
        $summary->book_id = $validatedData['book_id'];
        $summary->content = $validatedData['content'];
        $summary->status = 'need_review';

        $summary->save();

        return redirect()->route('summaries.index')->with('success', 'Summary created successfully');
    }

    public function show(Summary $summary)
    {
        return view('summaries.show', ['summary' => $summary, 'type_menu' => 'summaries']);
    }

    public function edit(Summary $summary)
    {
        return view('summaries.edit', ['summary' => $summary, 'type_menu' => 'summaries']);
    }

    public function update(Request $request,  Summary $summary)
    {
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

    public function destroy(Summary $summary)
    {
        $summary->delete();

        return redirect()->route('summaries.index')->with('success', 'Summary deleted successfully');
    }

    public function publish(Summary $summary)
    {
        $summary->student->point += 10;
        $summary->student->save();

        $summary->status = 'published';
        $summary->save();

        return redirect()->route('summaries.index')->with('success', 'Summary published successfully');
    }

    public function unpublish(Summary $summary)
    {
        $summary->student->point -= 10;
        $summary->student->save();

        $summary->status = 'need_review';
        $summary->save();

        return redirect()->route('summaries.index')->with('success', 'Summary unpublished successfully');
    }
}
