<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/files', 'UserFilesController@index');
Route::post('/file', 'UserFilesController@store');
Route::delete('/file/{file}', 'UserFilesController@destroy');
Route::get('/file/{file}', 'UserFilesController@download');
