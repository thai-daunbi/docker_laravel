<?php
use Illuminate\Support\Facades\Route;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
Route::get('/', function () {
    return app()->version();
});

$router->group(['prefix' => 'api/'], function () use ($router) {
    $router->get('getUser', 'UserController@index');
    $router->post('user', 'UserController@store');
    $router->get('getUser/{id}', 'UserController@show');
    $router->patch('getUser/{id}', 'UserController@update');
    $router->delete('getUser/{id}', 'UserController@destroy');
});

// Route::group(['prefix' => 'api'], function () {
//     // api.php 파일의 모든 라우트를 추가합니다.
//     require base_path('routes/api.php');
// });

// // 나머지 웹 애플리케이션 라우트를 추가합니다.
// Route::get('/', function () {
//     return view('welcome');
// });