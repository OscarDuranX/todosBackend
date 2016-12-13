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

//Route::get('/', function () {
//    return view('welcome');
//});

Gate::define('gate-name', function() {

});

Gate::define('impossible-gate', function() {
    return false; //No autorizat
});

Gate::define('easy-gate', function() {
    return true; //Autorizat
});

Gate::define('update-task1', function($user, $task) {
    return $user->id == $task->user_id;
});

Gate::define('update-task2', function($user, $task) {
    if($user->isAdmin()) return true;
    return $user->id == $task->user_id;
});

Gate::define('update-task3', function($user, $task) {
    if($user->isAdmin()) return true;
    if($user->hasRole('editor')) return true;
    return $user->id == $task->user_id;
});



Route::group(['middleware' => 'auth'], function (){
    Route::get('/tasks', function (){
       return view('tasks');
    });

    Route::get('/profile/tokens', function (){
        return view('tokens');
    });
});

Route::get('/', function (){
    return view('welcome');
});

Route::get('/phpinfo', function (){
    phpinfo();
});