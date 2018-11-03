<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
    Route::get('/', 'PagesController@index');
    
});

    
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');    
    Auth::routes();
    Route::get('/dashboard', 'DashboardController@index');

    Route::get('/uploadfile','UploadController@getView');
    //--------------upload file nad store in database
    Route::post('/insertfile',array('as'=>'insertfile','uses'=>'UploadController@insertFile'));
    

