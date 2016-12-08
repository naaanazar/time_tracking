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
    Route::get('/user/delete/{id}', 'UsersController@delete')->where(['id' => '[0-9]+']);
    Route::get('/user/update/{id}', 'UsersController@update')->where(['id' => '[0-9]+']);
    Route::post('/user/update/{id}', 'UsersController@update')->where(['id' => '[0-9]+']);
    Route::get('/user/all', 'TimeManageController@all');
    Route::get('/user/all/{team}', 'TimeManageController@all')->where(['team' => '[a-z]+']);

    // TimeManage Controller

    //home
    Route::get('/', 'TimeManageController@index');
    Route::get('/home', 'TimeManageController@index');

    // client
    Route::get('/client/create', 'TimeManageController@create_client');
    Route::post('/client/create', 'TimeManageController@create_client');

    // project
    Route::get('/project/create', 'TimeManageController@create_project');
    Route::post('/project/create', 'TimeManageController@create_project');

    //task
    Route::get('/task/create', 'TimeManageController@create_task');
    Route::post('/task/create', 'TimeManageController@create_task');

    // team
    Route::get('/team/create', 'TimeManageController@create_team');
    Route::post('/team/create', 'TimeManageController@create_team');
    Route::get('/team/delete/{id}', 'TimeManageController@delete_team')->where(['id' => '[0-9]+']);
    Route::get('/team/all', 'TimeManageController@team_all');

    // forbidden
    Route::get('/register', 'TimeManageController@index');
});

// Auth

Auth::routes();

// google login

Route::get('auth/google', 'Auth\LoginController@redirectToProvider');
Route::get('auth/google/callback', 'Auth\LoginController@handleProviderCallback');
//Route::get('auth/google/callback', 'TestController@test');

