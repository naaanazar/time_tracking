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

    // User Controller

    Route::get('/user/create', 'UsersController@create');
    Route::post('/user/create', 'UsersController@create');
    Route::get('/user/delete/{id}', 'UsersController@delete');
    Route::get('/user/update/{id}', 'UsersController@update');
    Route::post('/user/update/{id}', 'UsersController@update');
    Route::get('/user/all', 'TimeManageController@all');

    // TimeManage Controller

    Route::get('/', 'TimeManageController@index');
    Route::get('/client/create', 'TimeManageController@create_client');
    Route::get('/team/create', 'TimeManageController@create_team');
    Route::get('/team/delete/{id}', 'TimeManageController@delete_team');
    Route::get('/team/all', 'TimeManageController@team_all');

    Route::get('/register', 'TimeManageController@index');
});

// Auth

Auth::routes();

Route::get('auth/google', 'Auth\LoginController@redirectToProvider');
Route::get('auth/google/callback', 'Auth\LoginController@handleProviderCallback');
//Route::get('auth/google/callback', 'TestController@test');

