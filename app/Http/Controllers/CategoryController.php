<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Category;

class CategoryController extends Controller
{

    public function index(){

        $category= Category::all();

        foreach($category as $each){
            $each->book;
        }

        $respond = [
            'status'=> 201,
            'message' => "All categories",
            'data' => $category,
        ];

        return $respond;
    }

    public function get($id){

        $category= Category::find($id);

        if(!isset($category)){

            $respond = [
                'status'=> 401,
                'message' => "Category with id=$id doesn't exist",
                'data' => NULL,
            ];

            return $respond;
        }

        $category->book;

        $respond = [
            'status'=> 201,
            'message' => "successfully updated",
            'data' => $category,
        ];

        return $respond;
    }

    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
         ]);


        if ($validator->fails()) {
            $respond = [
                'status'=> 401,
                'message' =>  $validator->messages()->first(),
                'data' => null,
            ];

            return $respond;
        }

        $new_category = new Category;
        $new_category->name = $request->name;
        $new_category->slug = $request->slug;
        $new_category->save();

        $new_category->book()->attach($request->book);

        return $new_category;
    }

    public function update(Request $request, $id){

        $category = Category::find($id);

        if(!isset($category)){

            $respond = [
                'status'=> 201,
                'message' => "Category with id=$id doesn't exist",
                'data' => NULL,
            ];

            return $respond;
        }

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();

        $respond = [
            'status'=> 201,
            'message' => "successfully updated",
            'data' => $category,
        ];

        return $respond;
    }

    public function delete($id){

        $category= Category::find($id);

        if(!isset($category)){
            $respond = [
                'status'=> 401,
                'message' => "Category with id=$id doesn't exist",
                'data' => NULL,
            ];

            return $respond;

        }

        $category->delete();

        $respond = [
            'status'=> 201,
            'message' => "Category successfully deleted",
            'data' => Category::All(),
        ];

        return $respond;
    }
}
