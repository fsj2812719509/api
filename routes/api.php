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

Route::resource('/article','ArticleController',['except'=>['create','edit']])->middleWare('JwtToken');
Route::resource('/user','UserController',['except'=>['create','edit']]);
Route::resource('/register','RegisterController',['except'=>['create','edit']]);
Route::resource('/upload','UploadController',['except'=>['create','edit']]);
Route::resource('/logintest','LoginTestController',['except'=>['create','edit']])->middleWare('token');
Route::resource('/weatcher','WeatherController',['except'=>['create','edit']])->middleWare('token');
