<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return view('books.index', ['books' => $books, 'type_menu' => 'books']);
    }

    public function create()
    {
        return view('books.create', ['type_menu' => 'books']);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'publisher' => 'required|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'isbn' => 'required|unique:books|max:255',
            'cover' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'mimes:pdf|max:2048',
            'description' => 'required',
        ]);

        $book = new Book();

        $book->title = $validatedData['title'];
        $book->author = $validatedData['author'];
        $book->publisher = $validatedData['publisher'];
        $book->year = $validatedData['year'];
        $book->isbn = $validatedData['isbn'];
        $book->description = $validatedData['description'];

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $filename = time() . '.' . $cover->getClientOriginalExtension();
            Storage::putFileAs('public/books/covers', $cover, $filename);
            $book->cover = 'covers/' . $filename;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            Storage::putFileAs('public/books/files', $file, $filename);
            $book->file = 'files/' . $filename;
        }

        $book->save();

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function edit(Book $book)
    {
        return view('books.edit', ['book' => $book, 'type_menu' => 'books']);
    }

    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'publisher' => 'required|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'isbn' => 'required|unique:books,isbn,' . $book->id . '|max:255',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'required|mimes:pdf|max:2048',
            'description' => 'required',
        ]);

        $book->title = $validatedData['title'];
        $book->author = $validatedData['author'];
        $book->publisher = $validatedData['publisher'];
        $book->year = $validatedData['year'];
        $book->isbn = $validatedData['isbn'];
        $book->description = $validatedData['description'];

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $filename = time() . '.' . $cover->getClientOriginalExtension();
            Storage::putFileAs('covers', $cover, $filename);
            $book->cover = 'covers/' . $filename;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            Storage::putFileAs('public/books/files', $file, $filename);
            $book->file = 'files/' . $filename;
        }

        $book->save();

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
