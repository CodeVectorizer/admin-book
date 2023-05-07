<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['writings_count'] = \App\Models\Writing::count();
        $data['students_count'] = \App\Models\Student::count();
        $data['summary_count'] = \App\Models\Summary::count();
        $data['books_count'] = \App\Models\Book::count();

        $data['latest_writings'] = \App\Models\Writing::orderBy('created_at', 'desc')->take(5)->get();
        $data['latest_summaries'] = \App\Models\Summary::orderBy('created_at', 'desc')->take(5)->get();
        $data['top_reader'] = \App\Models\Student::orderBy('point', 'desc')->take(5)->get();

        return view('dashboard', ['data' => $data, 'type_menu' => 'dashboard']);
    }
}
