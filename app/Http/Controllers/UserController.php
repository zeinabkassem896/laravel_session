<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;





class UserController extends Controller
{

    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),]);
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user','token'),201);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
              try {
        if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
                }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

    public function signout() {
        // auth()->logout();
        Auth::guard('api')->attempt(['email' => 'zeinabss@gmail.com', 'password' => 'abc123']);
        // Auth::logout();
        if(Auth::check())
            return "true";
        else
            return "false";
        return response()->json(['message' => 'Successfully logged out']);
    }

}
