<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Author;

class AuthorController extends Controller
{
    public function index(){
        // $author  = Author::all();
        $author= Author::orderBy('first_name')->get();
        $respond = [
            'status'=> 200,
            'message' => "All Authors",
            'data' => $author,
        ];

        return $respond;
    }

    public function get($id){
        $author= Author::find($id);

        if(!isset($author)){

            $respond = [
                'status'=> 401,
                'message' => "Author of id=$id doesn't exist",
                'data' => $author,
            ];

            return $respond;
        }

        $respond = [
            'status'=> 201,
            'message' => "Author of id $id",
            'data' => $author,
        ];

        return $respond;
    }

    public function create(Request $request){

         $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
        ]);


        if ($validator->fails()) {
            $respond = [
                'status'=> 401,
                'message' =>  $validator->messages()->first(),
                'data' => null,
            ];

            return $respond;
        }

        $author = new Author;
        $author->first_name = $request->first_name;
        $author->last_name = $request->last_name;
        $author->save();

        return $author;

    }

    public function update(Request $request, $id){

        $author = Author::find($id);


        if(isset($author)){
            $author->first_name = $request->first_name;
            $author->last_name = $request->last_name;
            $author->save();

            $respond = [
                'status'=> 201,
                'message' =>  "Author updated successfully",
                'data' => $author,
            ];

            return $respond;
        }

        $respond = [
            'status'=> 401,
            'message' =>  "Author with id=$id doesn't exist",
            'data' => null,
        ];

        return $respond;

    }

    public function delete($id){
        $author = Author::find($id);

        if(isset($author)){
            $author->delete();
            $all_authors = Author::all();

            $respond = [
                'status'=> 401,
                'message' =>  "Author successfully deleted",
                'data' => $all_authors,
            ];
        }
        else{

            $respond = [
                'status'=> 401,
                'message' =>  "Author with id=$id doesn't exist",
                'data' => NUll,
            ];

        }

        return $respond;
    }
}
