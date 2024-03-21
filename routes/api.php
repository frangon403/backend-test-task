<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([
    'namespace'=>'App\Http\Controllers',
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::get('/users', function (Request $request) {
    return \App\Models\User::all();
});

//Без jwt токена
//Route::group(['namespace'=>'App\Http\Controllers'], function (){
Route::group(['namespace'=>'App\Http\Controllers', 'middleware' => 'jwt.auth'], function (){
    Route::get('/posts', 'PostController@index')->name('api.posts.index');
    Route::get('/posts/{post}','PostController@show')->name('api.post.show');
    Route::post('/posts','PostController@store')->name('api.post.store');
    Route::put('/posts/{post}','PostController@update')->name('api.post.update');
    Route::delete('/posts/{post}','PostController@destroy')->name('api.post.destroy');
});
