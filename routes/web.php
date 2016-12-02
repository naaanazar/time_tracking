<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => ['permision']], function () {

    // Users Controller

    Route::get('/user/create', 'UsersController@create_user');
    Route::get('/user/update/{id}', 'UsersController@update_user');
    Route::get('/user/delete/{id}', 'UsersController@delete_user');

    // TimeManage Controller

    Route::get('/', 'TimeManageController@index');
});

// Auth

Auth::routes();
