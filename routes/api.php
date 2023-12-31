<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BooksController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');

// Route::apiResource('/books', App\Http\Controllers\Api\BooksController::class);

Route::middleware('auth:api')->group(function () {
    // Route::apiResource('/books', BooksController::class);
    Route::get('/books', [BooksController::class, 'index']);
    Route::get('/books/{id}', [BooksController::class, 'show']);
    Route::post('/books/add', [BooksController::class, 'store']);
    Route::put('/books/{id}/edit', [BooksController::class, 'update']);
    Route::delete('/books/{id}/delete', [BooksController::class, 'destroy']);
});
