<?php


Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function () {
    Route::resource('task', 'TasksController');
    Route::resource('user', 'UsersController');
    Route::resource('user.task', 'UserTasksController');
//    Route::resource('task.user','TaskUserController');
});



//Route::resource('user' , 'UsersController');
//
