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

Route::get('startpage', function () {
    return view('startpage');
});

Route::get('login',function () {
    return view('login.index');
});

Route::get('register',function () {
    return view('login.register');
});

Route::get('admin', ['middleware' => 'auth', function () {
    return view('admin.index');
}]);

/*Login Routine*/
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@logout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//Script
Route::get('script/{id}',['uses' => 'ScriptCtrl@show']);

Route::get('script','ScriptCtrl@index');

Route::post('script','ScriptCtrl@store');
Route::post('script/{id}/edit',['uses'=>'ScriptCtrl@update']);
Route::get('script/{id}/edit',['uses'=>'ScriptCtrl@edit']);
Route::get('script/{id}/delete',['uses'=>'ScriptCtrl@destroy']);

//Block
Route::get('block', ['middleware' => 'auth', function () {
    return view('block.home');
} ]);

Route::post('block', ['middleware' => 'auth', 'uses'=>'BlockCtrl@store']);

Route::get('block/list', ['middleware' => 'auth', 'uses' => 'BlockCtrl@getList']);

Route::get('block/{id}',['middleware' => 'auth','uses' => 'BlockCtrl@edit']);

Route::post('block/{id}',['middleware' => 'auth','uses' => 'BlockCtrl@update']);

Route::get('block/{id}/delete',['middleware' => 'auth','uses' => 'BlockCtrl@destroy']);
