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
    return redirect('admin');
});

Route::get('login',function () {
    if (Auth::check())
    {
        return redirect('admin');
    }
    return view('login.index');
});

Route::get('register',function () {
    if (Auth::check())
    {
        return redirect('admin');
    }
    return view('login.register');
});

Route::get('admin', ['middleware' => 'auth', 'uses'=>'AdminCtrl@index' ]);
Route::get('admin/getNews/{isScript}', ['middleware' => 'auth', 'uses'=>'AdminCtrl@getNews']);

/*Login Routine*/
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@logout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//Script
Route::get('script', ['middleware' => 'auth', function () {
    return view('script.home');
} ]);

Route::post('script', ['middleware' => 'auth', 'uses'=>'ScriptCtrl@store']);

Route::get('script/list', ['middleware' => 'auth', 'uses' => 'ScriptCtrl@getList']);

Route::get('script/{id}',['middleware' => 'auth','uses' => 'ScriptCtrl@edit']);

Route::post('script/{id}',['middleware' => 'auth','uses' => 'ScriptCtrl@update']);

Route::get('script/{id}/delete',['middleware' => 'auth','uses' => 'ScriptCtrl@destroy']);

Route::get('script/{id}/view',['uses' => 'ScriptCtrl@show']);

//Block
Route::get('block', ['middleware' => 'auth', function () {
    return view('block.home');
} ]);

Route::post('block', ['middleware' => 'auth', 'uses'=>'BlockCtrl@store']);

Route::get('block/list', ['middleware' => 'auth', 'uses' => 'BlockCtrl@getList']);

Route::get('block/{id}',['middleware' => 'auth','uses' => 'BlockCtrl@edit']);

Route::post('block/{id}',['middleware' => 'auth','uses' => 'BlockCtrl@update']);

Route::get('block/{id}/delete',['middleware' => 'auth','uses' => 'BlockCtrl@destroy']);

//Kommentare
Route::get('comment', ['middleware' => 'auth', 'uses' => 'CommentCtrl@store']);

Route::get('comment/{id}', ['middleware' => 'auth', 'uses' => 'CommentCtrl@show']);

Route::get('comment/{id}/getNew/{isScript}', ['middleware' => 'auth', 'uses' => 'CommentCtrl@getNew']);

Route::get('comment/{id}/seen', ['middleware' => 'auth', 'uses' => 'CommentCtrl@setSeen']);

Route::get('comment/{id}/block_list', ['middleware' => 'auth', 'uses' => 'CommentCtrl@getBlockSection']);

Route::get('comment/{id}/script_list', ['uses' => 'CommentCtrl@getScriptSection']);

Route::get('comment/{id}/update', ['middleware' => 'auth', 'uses' => 'CommentCtrl@update']);

Route::get('comment/{id}/delete', ['middleware' => 'auth', 'uses' => 'CommentCtrl@destroy']);