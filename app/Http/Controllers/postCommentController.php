<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\post;
use App\Models\reply;
use App\Models\comment;
use App\Models\like;

class postCommentController extends Controller
{
     public function postmethode(Request $req){
        $post=new post;
        $user_id=Auth::id();

        $post->user_id=$user_id;
        $post->img=$req->file('img')->store('Products');
        $post->save();

         if ($post) {
              return response([
              'message'=>'post submit',
              'post'=>$post,
            ],200);
       }
       return response([
              'message'=>'post not submit'
             
        ],400);

    }

    public function postView(){
        return DB::table('posts')->join('Users','Users.id','=','posts.user_id')->select('posts.*','Users.id','Users.name')->get();   
    }

    public function commentpost(Request $req){
         $comment=new comment;
         $user_id=Auth::id();

         $comment->user_id=$user_id;
         $comment->comment=$req->input('comment');
         $comment->save();

         if ( $comment) {
              return response([
              'message'=>'post submit',
              'comment'=>$comment,
            ],200);
       }
       return response([
              'message'=>'post not submit'
             
        ],400);

    }

    public function commentView(){
        return DB::table('comments')->join('Users','Users.id','=','comments.user_id')->select('comments.*','Users.id','Users.name')->get();   
    }

    public function replypost(Request $req){
         $reply=new reply;
         $user_id=Auth::id();

         $reply->user_id=$user_id;
         $reply->reply=$req->input('reply');
         $reply->save();

         if ( $reply) {
              return response([
              'message'=>'post submit',
              'reply'=>$reply,
            ],200);
       }
       return response([
              'message'=>'post not submit'
             
        ],400);

    }

    public function replyView(){
        return DB::table('replies')->join('Users','Users.id','=','replies.user_id')->select('replies.*','Users.id','Users.name')->get();   
    }

    public function likepost(Request $req){
         $like=new like;
         $user_id=Auth::id();

         $like->user_id=$user_id;
         $like->like=$req->input('like');
         $like->save();

         if ( $like) {
              return response([
              'message'=>'post submit',
              'like'=>$like,
            ],200);
       }
       return response([
              'message'=>'post not submit'
        ],400);

    }

    public function likeCount(){
        return like::all()->count();
    }
}
