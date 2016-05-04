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



/*
 | ------------------------------------------------
 | Application Routes
 | ------------------------------------------------
 | This route group applies the "web" middleware group to every rout
 | it contains. The "web" middleware group is defined in your HTTP
 | kernel and includes session state, CSRF protection and more.
 |
 */
Route::group(['middleware' => ['web']], function() {

    Route::group(['middleware' => ['auth']], function() {

        Route::get('/task', 'TaskController@index');
        Route::post('/task', 'TaskController@indexPost');

    });


});

Route::auth();
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
