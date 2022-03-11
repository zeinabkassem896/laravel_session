<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;

class FileController extends Controller
{
    public function index(){

        $file= File::orderBy('name','desc')->get();
        // $file= File::all();

        $respond = [
            'status'=> 201,
            'message' => "All Files",
            'data' => $file,
        ];

        return $respond;
    }

    public function get($id){
        $file= File::find($id);

        if(!isset($file)){
            $respond = [
                'status'=> 201,
                'message' => "File with id=$id doesn't exist",
                'data' => NULL,
            ];
        }
        else{

            $respond = [
                'status'=> 201,
                'message' => "",
                'data' => $file,
            ];

        }

        return $respond;
    }

    public function create(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
         ]);

        $new_file = new File;
        $new_file->name = $request->name;
        $new_file->type = $request->type;
        $new_file->extension = $request->extension;
        $new_file->destination = $request->destination;
        $new_file->save();

        $respond = [
            'status'=> 201,
            'message' => "File successfully created",
            'data' => $new_file,
        ];

        return $respond;

    }

    public function update(Request $request, $id){

        $file = File::find($id);

        if(!isset($file)){
            $respond = [
                'status'=> 401,
                'message' => "File with id=$id doesn't exist",
                'data' => $file,
            ];

            return $respond;
        }

        $file->name = $request->name;
        $file->type = $request->type;
        $file->type = $request->extension;
        $file->type = $request->destination;
        $file->save();

        $respond = [
            'status'=> 201,
            'message' => "File successfully updated",
            'data' => $file,
        ];

        return $respond;
    }

    public function delete($id){
        $file= File::find($id);

        if(!isset($file)){
            $respond = [
                'status'=> 401,
                'message' => "File with id=$id doesn't exist",
                'data' => NULL,
            ];

            return $respond;

        }

        $file->delete();

        $respond = [
            'status'=> 201,
            'message' => "File successfully deleted",
            'data' => File::All(),
        ];

        return $respond;
    }
}
