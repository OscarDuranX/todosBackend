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
//            $token = "TODO";
//            $data =[
//                "access_token" => $token
//            ];
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

#adminlte_routes
    Route::get('bootstraplayout', 'BootstraplayoutController@index')->name('bootstraplayout');

    Route::get('flexboxlayout', 'FlexboxlayoutController@index')->name('flexboxlayout');

    Route::get('csstables', 'CsstablesController@index')->name('csstables');

    Route::get('boxmodel', 'BoxmodelController@index')->name('boxmodel');


Route::get('/float', function (){
    return view('float');
});





