<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Registerrequest;
use App\Models\User;
use Auth;
use DB;


class AuthController extends Controller
{
    public function login(Request $req){

        if (Auth::attempt($req->only('email','password'))) {
             $user= Auth::User();
             $token=$user->createToken('app')->accessToken;
             return response([
                'message'=>"successfull login",
                'token'=>$token,
                'User'=>$user
            ],200);
         } 
         return response([
                'message'=>"successfull not login",
                
            ],401);
    }

    public function Register(Registerrequest $request){
       $user=User::create([
           'name'=>$request->name,
           'email'=>$request->email,
           'password'=>Hash::make($request->password)
        ],200);

        $token=$user->createToken('app')->accessToken;

        
         return response([
               'message'=>"successfull Registration",
                'token'=>$token,
                'user'=>$user
        ],200);
    }
}
