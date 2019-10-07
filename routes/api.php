<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Resource route  usage
//Route::resource('posts','PostController')->except(['edit','create']);

//get all
Route::get('posts','PostController@index');
// get by id
Route::get('posts/{id}','PostController@show');
// add post
Route::post('posts','PostController@store');
// update post
Route::post('posts/{id}','PostController@update');

Route::get('posts/delete/{id}','PostController@delete');

