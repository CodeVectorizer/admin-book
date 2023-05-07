<?php

namespace App\Http\Controllers;

use App\Models\Writing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WritingController extends Controller
{
    public function index()
    {
        $writings = Writing::all();

        return view('writings.index', ['writings' => $writings, 'type_menu' => 'writings']);
    }

    public function create()
    {
        return view('writings.create', ['type_menu' => 'writings']);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            // 'cover' => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|max:255',
        ]);

        $writing = new Writing();

        $writing->fill($validatedData);
        $writing->status = 'need_review';
        $writing->student_id = 1;

        // if ($request->hasFile('cover')) {
        //     $cover = $request->file('cover');
        //     $fileName = time() . '_' . $cover->getClientOriginalName();
        //     Storage::putFileAs('public/writings/covers', $cover, $fileName);

        //     $writing->cover = 'covers/' . $fileName;
        // }

        $writing->cover = 'covers/default.jpg';
        $writing->save();

        return redirect()->route('writings.index')->with('success', 'Writing created successfully.');
    }

    public function show(Writing $writing)
    {
        return view('writings.show', compact('writing'), ['type_menu' => 'writings']);
    }

    public function edit(Writing $writing)
    {
        return view('writings.edit', compact('writing'), ['type_menu' => 'writings']);
    }

    public function update(Request $request, Writing $writing)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            // 'cover' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|max:255',
        ]);

        $writing->title = $validatedData['title'];
        $writing->content = $validatedData['content'];
        $writing->description = $validatedData['description'];
        $writing->status = $validatedData['status'];

        // if ($request->hasFile('cover')) {
        //     $cover = $request->file('cover');
        //     $fileName = time() . '_' . $cover->getClientOriginalName();
        //     Storage::putFileAs('public/writings/covers', $cover, $fileName);
        //     $writing->cover = 'covers/' . $fileName;
        // }

        $writing->cover = 'covers/default.jpg';

        $writing->save();

        return redirect()->route('writings.index')->with('success', 'Writing updated successfully.');
    }

    public function destroy(Writing $writing)
    {
        Storage::delete($writing->cover);
        $writing->delete();
        return redirect()->route('writings.index')->with('success', 'Writing deleted successfully.');
    }

    public function publish(Writing $writing)
    {
        $writing->status = 'published';
        $writing->save();
        return redirect()->route('writings.index')->with('success', 'Writing published successfully.');
    }

    public function unpublish(Writing $writing)
    {
        $writing->status = 'need_review';
        $writing->save();
        return redirect()->route('writings.index')->with('success', 'Writing unpublished successfully.');
    }
}
