<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index($student_id = null)
    {
        $books = Book::latest()->get();
        // mapping book->covers  to link storage
        $books->map(function ($book) use ($student_id) {
            $book->cover = env('APP_URL') . '/app/books/' . $book->cover;
            $book->file = env('APP_URL') . '/app/books/' . $book->file;
            $book->is_read = $book->summaries()->where('student_id', $student_id)->exists();
            return $book;
        });

        return response()->json([
            'success' => true,
            'message' => 'List Data Buku',
            'data'    => $books
        ], 200);
    }

    public function show($id, $student_id = null)
    {
        $book = Book::find($id);
        // dd($book, $book->summaries);
        $book->cover = env('APP_URL') . '/app/books/' . $book->cover;
        $book->file = env('APP_URL') . '/app/books/' . $book->file;
        $book->is_read = $book->summaries()->where('student_id', $student_id)->where('status', 'published')->exists();

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan',
                'data'    => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Buku',
            'data'    => $book
        ], 200);
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

        // dd($validatedData);
        $book = new Book();
        $book->fill($validatedData);

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

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil ditambahkan',
            'data'    => $book
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan',
                'data'    => null
            ], 404);
        }

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

        $book->fill($validatedData);

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

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil diupdate',
            'data'    => $book
        ], 200);
    }

    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan',
                'data'    => null
            ], 404);
        }

        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil dihapus',
            'data'    => $book
        ], 200);
    }
}
