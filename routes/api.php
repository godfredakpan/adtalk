<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::namespace("Api")->prefix('v1')->group(function () {
    Route::post('calls', 'CallController@makeCall');
    Route::post('calls/infobip/notifications', 'CallController@receiveCallStatus');
    
    
});
    /* Api for AUTH */
    Route::post('login', 'API\UserController@login');
    Route::post('register', 'API\UserController@register');
    Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');

    // List Videos
    Route::get('video', 'VideoController@index');
    // List single Video
    Route::get('video/{id}', 'VideoController@show');
    // Create new Video
    Route::post('video', 'VideoController@store');
    // Update Video
    Route::put('video', 'VideoController@store');
    // Delete Video
    Route::delete('video/{id}', 'VideoController@destroy');

    
    
});



