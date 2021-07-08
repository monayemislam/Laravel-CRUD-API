<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//BOOk API
//add book
Route::post('/add-new-book', [ApiController::class, 'addBook']);
//book list
Route::get('/book-list',[ApiController::class,'allBooks']);
//find a single book
Route::get('/single-book/{id}',[ApiController::class,'getSingleBook']);
//delete book
Route::delete('/delete-book/{id}',[ApiController::class,'deleteBook']);
//update book
Route::put('/update-book/{id}',[ApiController::class,'updateBook']);