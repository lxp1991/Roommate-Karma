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

    Route::group(['prefix' => 'address'], function () {
        Route::get('update', function()
        {
            return View::make('address');
        });

        Route::post('update', 'AddressController@store');
    });



    //TODO
    Route::get('/password/reset', function() {
        return view('auth.passwords.email');
    })->middleware('auth');


    Route::get('/map', 'MapController@draw');

        
    Route::group(['prefix' => 'task'], function () {
        Route::get('view', 'TaskController@view');
        Route::get('list', 'TaskController@listAll');
        Route::post('list/done/{taskId}', 'TaskController@done');
        Route::post('/view/{taskId}', 'TaskController@take');
        Route::post('create', 'TaskController@store');
        Route::get('create', function() {
            return view('createtask');
        });
    });

    Route::get('/settings', function() {
    	return view('settings');
    })->middleware('auth');


    Route::group(['prefix' => 'user'], function () {
        Route::get('list', 'ProfileController@showUserList');
        Route::post('list/follow/{userId}', 'FollowingController@follow');
        Route::post('list/unfollow/{userId}', 'FollowingController@unfollow');
    });



    Route::get('/profile', 'ProfileController@showCurrentUser')->middleware('auth');

    Route::get('/profile/{id}', 'ProfileController@showUserById')->middleware('auth');

});
