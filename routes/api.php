<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\postCommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// login route;
Route::post('login',[AuthController::class,'login']);

// Register_Router;
Route::post('Register',[AuthController::class,'Register']);

//Forgetpassword;
Route::post('Forgetpassword',[ForgetController::class,'Forgetpassword']);

//Rest Password;
Route::post('RessetPassword',[ForgetController::class,'RessetPassword']);

//User

Route::get('User',[UserController::class,'User'])-> middleware('auth:api');

//personal Informational 
Route::post('addPerson',[PersonalController::class,'addPerson']);
Route::get('personal',[PersonalController::class,'personal']);
Route::get('personalget/{id}',[PersonalController::class,'personalget']);
Route::delete('personalDelete/{id}',[PersonalController::class,'personalDelete']);
Route::put('personalUpdate/{id}',[PersonalController::class,'personalUpdate']);

//post
Route::post('postmethode',[postCommentController::class,'postmethode'])->middleware('auth:api');
Route::get('postView',[postCommentController::class,'postView']);
Route::post('commentpost',[postCommentController::class,'commentpost'])->middleware('auth:api');
Route::get('commentView',[postCommentController::class,'commentView']);
Route::post('replypost',[postCommentController::class,'replypost'])->middleware('auth:api');
Route::get('replyView',[postCommentController::class,'replyView']);
Route::post('likepost',[postCommentController::class,'likepost'])->middleware('auth:api');
Route::get('likeCount',[postCommentController::class,'likeCount']);