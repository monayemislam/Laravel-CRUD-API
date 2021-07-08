<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class ApiController extends Controller
{
    //Create or add book API-Post
    //URL:http://127.0.0.1:8000/api/add-new-book
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
        //URL:
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

    //List of all books
    //URL:http://127.0.0.1:8000/api/book-list
    public function allBooks()
    {
        $books = Book::get();
        return response()->json([
            'status'=>1,
            'message'=>'List of all books',
            'data'=>$books
        ]);
    }

    //find a single book
    //URL:http://127.0.0.1:8000/api/single-book/2
    public function getSingleBook($id)
    {
        if(Book::where('id',$id)->exists())
        {
            $bookDetails=Book::where('id',$id)->first();
            return response()->json([
                'status'=>1,
                'message'=>"Book Found",
                'data'=>$bookDetails
            ]);
        }
        else
        {
            return response()->json([
                'status'=>0,
                'message'=>"Book not Found"
            ]);
        }
    }

    //Delete a book from list
    //URL:http://127.0.0.1:8000/api/delete-book/4
    public function deleteBook($id)
    {
        if(Book::where('id',$id)->exists())
        {
            $book = Book::where('id',$id)->first();
            $book->delete();
            return response()->json([
                'status'=>1,
                'message'=>'Book deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=>0,
                'message'=>'Book not found'
            ]);
        }
    }
    //Update Book Info
    //URL:http://127.0.0.1:8000/api/update-book/1
    public function updateBook(Request $request,$id)
    {
        if(Book::where('id',$id)->exists())
        {
            $book=Book::find($id);

            $book->name=!empty($request->name)?$request->name:$book->name;
            $book->author=!empty($request->author)?$request->author:$book->author;
            $book->genre=!empty($request->genre)?$request->genre:$book->genre;
            $book->year=!empty($request->year)?$request->year:$book->year;
            $book->save();

            return response()->json([
                'status'=>1,
                'message'=>'Data has been updated successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=>0,
                'message'=>'Book Not Found',
            ]);
        }
    }

}
