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

Auth::routes();

Route::get('/home', 'FileController@index')->name('home');
Route::get('/users', 'UserController@index')->name('users');
Route::post('/users/update/{id}','UserController@update');
Route::delete('/users/{id}','UserController@destroy');
// Route::post('/users/{id}/edit','UserController@update');
Route::resource('/users','UserController');

Route::get('image-upload', 'FileController@imageUpload')->name('image.upload');
Route::post('image-upload', 'FileController@imageUploadPost')->name('image.upload.post');
Route::delete('image-upload/{id}', 'FileController@destroy');