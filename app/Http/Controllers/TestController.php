<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;



class AuthorController extends Controller
{
    public function index(){

        $author= Author::orderBy('first_name')->get();

        $respond = [
            'status'=> 201,
            'message' => "All the authors",
            'data' => $author,
        ];

        // return response()->json($respond, 201);
        return $respond;
    }

    public function get($id){
        $author= Author::find($id);
        $author->book;

        $respond = [
            'status'=> 201,
            'message' => "Author of id $id",
            'data' => $author,
        ];

        // return response()->json($respond, 201);
        return $respond;
    }

    public function create(Request $request){

        // $validator = $this->validate($request, [
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //  ]);

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            $respond = [
                'status'=> 401,
                'message' =>  $validator->messages()->first(),
                'data' => null,
            ];

            return $respond;
        }

        $new_author = new Author;
        $new_author->first_name = $request->first_name;
        $new_author->last_name = $request->last_name;
        $new_author->save();

        return $new_author;
    }

    public function update(Request $request, $id){

        $author = Author::find($id);
        $author->first_name = $request->first_name;
        $author->last_name = $request->last_name;
        $author->save();

        $respond = [
            'status'=> 201,
            'message' => "successfully updated",
            'data' => $author,
        ];

        // return response()->json($respond, 201);
        return $respond;
    }

    public function delete($id){
        $author= Author::find($id)->delete();

        $respond = [
            'status'=> 201,
            'message' => "successfully deleted",
            'data' => $author,
        ];

        // return response()->json($respond, 201);
        return $respond;
    }
}
