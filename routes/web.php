<?php

  Route::get('/', function () {
    return view('welcome');
  });

  Auth::routes();

  Route::get('/home', 'HomeController@index')->name('home');

  Route::resource('projects', 'ProjectController');

  Route::resource('tasks', 'TaskController');

  Route::post('tasks/{task}/status', 'TaskController@status')->name('tasks.status');
  Route::get('tasks/{task}/deadline', 'TaskController@deadlineEdit')->name('tasks.deadline.edit');
  Route::post('tasks/{task}/deadline', 'TaskController@deadlineUpdate')->name('tasks.deadline.update');
  Route::post('tasks/{task}/position-up', 'TaskController@positionUp')->name('tasks.position-up');
  Route::post('tasks/{task}/position-down', 'TaskController@positionDown')->name('tasks.position-down');
