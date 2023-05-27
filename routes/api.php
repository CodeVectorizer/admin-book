<?php

use App\Http\Controllers\API\V1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\BookController;
// use App\Http\Controllers\API\V1\CampusController;

use App\Http\Controllers\API\V1\StudentController;
use App\Http\Controllers\API\V1\SummaryController;
use App\Http\Controllers\API\V1\WritingController;
use App\Models\Campus;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// group middleware
// book
Route::get('books/{id}/all', [BookController::class, 'index']);
Route::get('books/{id}/{student_id}', [BookController::class, 'show']);
Route::post('books', [BookController::class, 'store']);
Route::put('books/{id}', [BookController::class, 'update']);
Route::delete('books/{id}', [BookController::class, 'destroy']);

// writing
Route::get('writings', [WritingController::class, 'index']);
Route::get('writings/{id}', [WritingController::class, 'show']);
Route::post('writings', [WritingController::class, 'store']);
Route::put('writings/{id}', [WritingController::class, 'update']);
Route::delete('writings/{id}', [WritingController::class, 'destroy']);

// summary
Route::get('summaries/{id}/all', [SummaryController::class, 'index']);
Route::get('summaries/{id}', [SummaryController::class, 'show']);
Route::post('summaries', [SummaryController::class, 'store']);
Route::put('summaries/{id}', [SummaryController::class, 'update']);
Route::delete('summaries/{id}', [SummaryController::class, 'destroy']);

Route::get('students', [StudentController::class, 'index']);
Route::get('students/{id}', [StudentController::class, 'show']);

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
