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

// group the following routes by auth middleware - you have to be signed-in to proceeed
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

    // Posts resourcfull controllers routes
    Route::resource('posts', 'App\Http\Controllers\PostController');

    // Comments routes
    Route::prefix('/comments')->name('comments.')->group(function () {
        // store comment route
        Route::post('/{post}', 'App\Http\Controllers\CommentController@store')->name('store');
    });

    // Replies routes
    Route::prefix('/replies')->name('replies.')->group(function () {
        // store reply route
        Route::post('/{comment}', 'App\Http\Controllers\ReplyController@store')->name('store');
    });
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
