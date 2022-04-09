<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ForgetRequest;
use App\Http\Requests\resetPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\ForgetMail;
use DB;
use Mail;

class ForgetController extends Controller
{
   public function Forgetpassword(ForgetRequest $req){
     $email =$req->email;
     if (User::where('email',$email)->doesntExist()) {
         return response([
            'message'=>'Email Not Found'
         ],404);
     }

     $token=rand(10,10000);

     DB::table("password_resets")->insert([
          'email'=>$email,
          'token'=>$token
     ]);

     Mail::to($email)->send(new ForgetMail($token)); //send to user forget password mail;
     return response([
        'message'=>'Reset password mail send on your email!'
     ],200);
   }

   public function RessetPassword(resetPassword $req){
      $email=$req->email;
      $token=$req->token;
      $password=Hash::make($req->password);


      $emailCheck=DB::table('password_resets')->where('email',$email)->first();
      $pinCheck=DB::table('password_resets')->where('token',$token)->first();


      if(!$emailCheck){

         return response([
            'message'=>"Email Invalid"

         ],401);
         
      }

       if(!$pinCheck){

         return response([
            'message'=>"Token Invalid"

         ],401);
         
      }

      DB::table('users')->where('email',$email)->update(['password'=>$password]);
      DB::table('password_resets')->where('email',$email)->delete();

      return response([
        'message'=>"Password Reset Successfull"

      ],200);

   }
}
