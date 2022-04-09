<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\personalinformation;

class PersonalController extends Controller
{
    public function personal(){
       $personal=personalinformation::All();

       return $personal;
    }

    public function personalDelete($id){
        $result=personalinformation::where('id',$id)->delete();
       if ($result) {
          return["result"=>"Product has been deleted"];
       }

       else{
           return["result"=>"Deleted has been filed"];
       }
   }

   public function addPerson(Request $req){
      $result= new personalinformation;

      $result->name=$req->input('name');
      $result->phone=$req->input('phone');
      $result->save();

      if($result){
            return response([
           'message'=>"successfull Add person"

          ],200);
      }else{
        return response([
            'message'=>"successfull Not Add person"

         ],401);
      }

   }

   public function personalUpdate(Request $req ,$id){
      $result=personalinformation::find($id);

      $result->name=$req->input('name');
      $result->phone=$req->input('phone');
      $result->update();

      if($result){
            return response([
           'message'=>"successfull Update person"

          ],200);
      }else{
        return response([
            'message'=>"successfull Not Update person"

         ],401);
      }

   }

   public function personalget($id){
     return personalinformation::find($id);
   }

}