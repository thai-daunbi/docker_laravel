<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/getUser/{id}', [UserController::class, 'getUser']);

Route::group(['prefix' => 'api'], function () {
    Route::get('getUser', 'UserController@index');
    Route::post('getUser', 'UserController@store');
    Route::get('getUser/{id}', 'UserController@show');
    Route::patch('getUser/{id}', 'UserController@update');
    Route::delete('getUser/{id}', 'UserController@destroy');
});