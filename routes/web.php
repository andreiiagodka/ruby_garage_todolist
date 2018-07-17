<?php

  Route::get('/', function () {
    return view('welcome');
  });

  Auth::routes();

  Route::get('/home', 'HomeController@index')->name('home');

  Route::resource('projects', 'ProjectController');
  
  Route::resource('tasks', 'TaskController');
  Route::post('tasks/{task}/status', 'TaskController@status')->name('tasks.status');
