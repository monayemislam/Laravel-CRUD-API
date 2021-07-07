<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class ApiController extends Controller
{
    //Create or add book API-Post
    public function addBook(Request $request)
    {
       //validate data
        $request->validate([
            "name"=>"required",
            "author"=>"required",
            "genre"=>"required",
            "year"=>"required"
        ]);
        //create data
        $book = new Book();
        $book->name=$request->name;
        $book->author=$request->author;
        $book->genre=$request->genre;
        $book->year=$request->year;
        $book->save();
        //response after save
        return response()->json([
            'status'=>1,
            'message'=>"New book has been added Successfully"
        ]);
    }
}
