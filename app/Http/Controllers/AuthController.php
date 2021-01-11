<?php

namespace App\Http\Controllers;


use App\User;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api',['except' =>['login', 'register']]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('idNumber' ,'password');
        if ($token = auth('api')->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['status' => false, 'error' =>'Invalid idNumber or password']);
    } 

    public function register(Request $request)
    {
        $record = new User;
        $record->idNumber = $request->idNumber;
        $record->fullName = $request->fullName;
        $record -> password = Hash::make($request->password);
        $record->course = $request->course;

        $record->save();

        return response()->json(['status' => true, 'message' => 'User Createred']);

    }

    public function guard(){
        return \Auth::guard('api');
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'acces_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTl() * 60,
        ]);
    }

}
