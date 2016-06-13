<?php

Route::group(['middleware' => ['web']], function() {

    Route::group(['middleware' => ['auth']], function() {

        Route::get('/projects', 'ProjectController@get')->name('projects.index');;
        Route::post('/projects/save', 'ProjectController@save')->name('projects.save');
        Route::get('/projects/{id}/edit', 'ProjectController@edit');
        Route::patch('/projects/update/{id}', 'ProjectController@update');

        Route::delete('/projects/{id}/delete', 'ProjectController@delete');

        Route::get('/project/{id}/tasks/view/{status}', 'TaskController@getTasksByProject');
        Route::post('/tasks/save', 'TaskController@save')->name('tasks.save');
        Route::get('/task/{id}/edit', 'TaskController@edit')->name('tasks.edit');
        Route::patch('/task/{id}/update', 'TaskController@update');
        Route::delete('/task/{id}/delete', 'TaskController@delete');

    });
    
});

Route::auth();
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
