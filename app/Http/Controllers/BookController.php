<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\File;
use App\Models\Author;
use App\Models\Category;


class BookController extends Controller
{
    public function index(){

        $book= Book::all();

        foreach($book as $each){
            $each->file;
            $each->author;
            $each->category;
        }

        $respond = [
            'status'=> 201,
            'message' => "All books",
            'data' => $book,
        ];

        return $respond;
    }

    public function get($id){

        $book= Book::find($id);
        if(!isset($book)){

            $respond = [
                'status'=> 01,
                'message' => "Book with id=$id doesn't exist",
                'data' => NULL,
            ];

            return $respond;
        }

        $book->file;
        $book->author;
        $book->category;

        $respond = [
            'status'=> 201,
            'message' => "successfully updated",
            'data' => $book,
        ];

        return $respond;
    }

    public function create(Request $request){

        $this->validate($request, [
            'title' => 'required',
            'author_id' => 'required',
            'file_id' => 'required',
         ]);

        // $category = Category::find(1);

        $author= Author::find($request->author_id);
        $file= File::find($request->file_id);

        if(!isset($author)){
            $respond = [
                'status'=> 404,
                'message' => "Author doesn't exit",
                'data' => NULL,
            ];

            return $respond;
        }

        if(!isset($file)){
            $respond = [
                'status'=> 404,
                'message' => "File doesn't exit",
                'data' => NULL,
            ];

            return $respond;
        }


        $new_book = new Book;
        $new_book->title = $request->title;
        $new_book->description = $request->description;
        $new_book->amazon_url = $request->amazon_url;
        $new_book->author_id = $request->author_id;
        $new_book->file_id = $request->file_id;
        $new_book->save();

        $new_book->file;
        $new_book->author;


        $category = Category::find(2);
        if(isset($category)){
            $new_book->category()->attach(2);
        }

        $respond = [
            'status'=> 201,
            'message' => "Book successfully created",
            'data' => $new_book,
        ];

        return $respond;
    }

    public function update(Request $request, $id){

        $book = Book::find($id);

        if(!isset($book)){

            $respond = [
                'status'=> 401,
                'message' => "Book with id=$id doesn't exist",
                'data' => NULL,
            ];

            return $respond;
        }

        $author= Author::find($request->author_id);
        $file= File::find($request->file_id);

        if(!isset($author)){
            $respond = [
                'status'=> 404,
                'message' => "Author doesn't exit",
                'data' => NULL,
            ];

            return $respond;
        }

        if(!isset($file)){
            $respond = [
                'status'=> 404,
                'message' => "File doesn't exit",
                'data' => NULL,
            ];

            return $respond;
        }


        $book->title = $request->title;
        $book->description = $request->description;
        $book->amazon_url = $request->amazon;
        $book->author_id = $request->author_id;
        $book->file_id = $request->file_id;
        $book->save();

        $respond = [
            'status'=> 201,
            'message' => "Book successfully updated",
            'data' => $book,
        ];

        return $respond;
    }

    public function delete($id){
        $book= Book::find($id);

        if(isset($book)){
            $book->delete();
            $all_books = Book::all();

            $respond = [
                'status'=> 401,
                'message' =>  "Book successfully deleted",
                'data' => $all_books,
            ];
        }
        else{

            $respond = [
                'status'=> 401,
                'message' =>  "Book with id=$id doesn't exist",
                'data' => NUll,
            ];

        }
        return $respond;
    }
}
