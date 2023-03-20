<?php

use Illuminate\Support\Facades\Route;

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
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/home', 'HomeController@index')->name('home');

    // Posts resourceful controller routes
    Route::resource('posts', 'PostController');

    // Comments routes
    Route::prefix('/comments')->as('comments.')->group(function () {
        // store comment route
        Route::post('/{post}', 'CommentController@store')->name('store');
    });

    // Replies routes
    Route::prefix('/replies')->as('replies.')->group(function () {
        // store reply route
        Route::post('/{comment}', 'ReplyController@store')->name('store');
    });
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
