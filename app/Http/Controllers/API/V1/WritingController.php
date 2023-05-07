<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Writing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class WritingController extends Controller
{
    public function index()
    {
        $writings = Writing::latest()->get();
        $writings->map(function ($writing) {
            $writing->cover = env('APP_URL') . Storage::url('writings/' . $writing->cover);
            return $writing;
        });
        return response()->json([
            'success' => true,
            'message' => 'List Data Writing',
            'data'    => $writings
        ], 200);
    }

    public function show($id)
    {
        $writing = Writing::find($id);

        $writing->cover = env('APP_URL') . Storage::url('writings/' . $writing->cover);

        if (!$writing) {
            return response()->json([
                'success' => false,
                'message' => 'Writing tidak ditemukan',
                'data'    => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Writing',
            'data'    => $writing
        ], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'cover' => 'file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|max:255',
        ]);


        $writing = new Writing();

        $writing->fill($validatedData);
        $writing->status = 'need_review';
        $writing->student_id = 1;

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $filename = time() . '.' . $cover->getClientOriginalExtension();
            Storage::putFileAs('public/writings/covers', $cover, $filename);
            $writing->cover = 'covers/' . $filename;
        }

        $writing->save();

        return response()->json([
            'success' => true,
            'message' => 'Writing berhasil ditambahkan',
            'data'    => $writing
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $writing = Writing::find($id);

        if (!$writing) {
            return response()->json([
                'success' => false,
                'message' => 'Writing tidak ditemukan',
                'data'    => null
            ], 404);
        }

        $validatedData = $request->validate([
            'student_id' => 'required',
            'title' => 'required|max:255',
            'content' => 'required',
            'cover' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
            'status' => 'required',
        ]);

        $writing->fill($validatedData);

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $filename = time() . '.' . $cover->getClientOriginalExtension();
            Storage::putFileAs('public/writings/covers', $cover, $filename);
            $writing->cover = 'covers/' . $filename;
        }

        $writing->save();

        return response()->json([
            'success' => true,
            'message' => 'Writing berhasil diupdate',
            'data'    => $writing
        ], 200);
    }

    public function destroy($id)
    {
        $writing = Writing::find($id);

        if (!$writing) {
            return response()->json([
                'success' => false,
                'message' => 'Writing tidak ditemukan',
                'data'    => null
            ], 404);
        }

        $writing->delete();

        return response()->json([
            'success' => true,
            'message' => 'Writing berhasil dihapus',
            'data'    => $writing
        ], 200);
    }

    public function review($id)
    {
        $writing = Writing::find($id);
        $writing->status = 'reviewed';
        $writing->save();
        return response()->json([
            'success' => true,
            'message' => 'Writing berhasil diupdate',
            'data'    => $writing
        ], 200);
    }
}
