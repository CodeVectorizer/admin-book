<?php

namespace App\Http\Controllers;

use App\Models\Writing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WritingController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $writings = Writing::all();
        return view('writings.index', ['writings' => $writings, 'type_menu' => 'writings']);
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('writings.create', ['type_menu' => 'writings']);
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'cover' => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|max:255',
        ]);

        $writing = new Writing();

        $writing->title = $validatedData['title'];
        $writing->content = $validatedData['content'];
        $writing->description = $validatedData['description'];
        $writing->status = 'need_review';
        $writing->student_id = 1;

        $cover = $request->file('cover');
        $fileName = time() . '_' . $cover->getClientOriginalName();
        Storage::putFileAs('public/writings/covers', $cover, $fileName);

        $writing->cover = 'covers/' . $fileName;
        $writing->save();

        return redirect()->route('writings.index')->with('success', 'Writing created successfully.');
    }

    // Display the specified resource.
    public function show(Writing $writing)
    {
        return view('writings.show', compact('writing'), ['type_menu' => 'writings']);
    }

    // Show the form for editing the specified resource.
    public function edit(Writing $writing)
    {
        return view('writings.edit', compact('writing'), ['type_menu' => 'writings']);
    }

    // Update the specified resource in storage.
    public function update(Request $request, Writing $writing)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'cover' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|max:255',
        ]);

        $writing->title = $validatedData['title'];
        $writing->content = $validatedData['content'];
        $writing->description = $validatedData['description'];
        $writing->status = $validatedData['status'];

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $fileName = time() . '_' . $cover->getClientOriginalName();
            Storage::putFileAs('public/writings/covers', $cover, $fileName);
            $writing->cover = 'covers/' . $fileName;
        }

        $writing->save();

        return redirect()->route('writings.index')->with('success', 'Writing updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(Writing $writing)
    {
        Storage::delete($writing->cover);
        $writing->delete();
        return redirect()->route('writings.index')->with('success', 'Writing deleted successfully.');
    }
}
