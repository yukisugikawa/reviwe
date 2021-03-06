<?php

use Illuminate\Support\Facades\Route;

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

Route::resource('/post', 'PostController');
Route::resource('/commnet', 'CommentController');

Route::post('/post/{post}/likes', 'LikesController@store');
Route::post('/post/{post}/likes/{like}', 'LikesController@destroy');

//ユーザー
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();