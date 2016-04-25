<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// Route::get('/error/404', function () {
//     return view('error.404');
// });

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', function() {
		return view('home');
	})->middleware('auth');
    
    Route::get('/charts', function()
	{
		return View::make('mcharts');
	})->middleware('auth');

    Route::get('/address/update', function()
    {
        return View::make('address');
    })->middleware('auth');

    Route::post('/address/update', 'AddressController@store');

    //TODO
    Route::get('/password/reset', function() {
        return view('auth.passwords.email');
    })->middleware('auth');


    Route::get('/map', 'MapController@draw');

    Route::get('/task/view', 'TaskController@view');

    Route::get('/task/list', 'TaskController@listAll');

    Route::post('/task/list/done/{taskId}', 'TaskController@done');

    Route::post('/task/view/{taskId}', 'TaskController@take');

    Route::post('/task/create', 'TaskController@store');
        
    Route::get('/task/create', function() {
        // return "Hello";
        return view('createtask');
    })->middleware('auth');
    


    Route::get('/settings', function() {
    	return view('settings');
    })->middleware('auth');


    Route::get('/user/list', 'ProfileController@showUserList')->middleware('auth');

    Route::post('/user/list/follow/{userId}', 'FollowingController@follow');

    Route::post('/user/list/unfollow/{userId}', 'FollowingController@unfollow');

    Route::get('/profile', 'ProfileController@showCurrentUser')->middleware('auth');

    Route::get('/profile/{id}', 'ProfileController@showUserById')->middleware('auth');

});
