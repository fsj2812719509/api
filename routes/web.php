<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::any('/login','LoginController@login');
Route::any('/loginList','LoginController@loginList');
Route::any('/register','LoginController@register');
Route::any('/registerList','LoginController@registerList');
Route::any('/uploadView','LoginController@uploadView');
Route::any('/uploadDo','LoginController@upload');
Route::any('/logintest','LoginController@test');
Route::any('/wind','LoginController@wind');
Route::any('/windlist','LoginController@windlist');