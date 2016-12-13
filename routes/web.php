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




Route::group(['middleware' => 'auth'], function (){
    Route::group(['middleware' => 'can:show,App\Task'], function(){

        Route::get('/tasks', function (){
            return view('tasks');
        });

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