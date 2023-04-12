<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReplyController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Posts resourceful controller routes
    Route::resource('posts', PostController::class);
    

    // Comments routes
    Route::prefix('/comments')->as('comments.')->group(function () {
        // store comment route
        Route::post('/{post}', [CommentController::class, 'store'])->name('store');
    });

    // Replies routes
    Route::prefix('/replies')->as('replies.')->group(function () {
        // store reply route
        Route::post('/{comment}', [ReplyController::class, 'store'])->name('store');
    });
});

<<<<<<< HEAD
Route::middleware('auth')->group(function () {
    Route::post('like', 'LikeController@like')->name('like');
    Route::delete('like', 'LikeController@unlike')->name('unlike');
});

=======
>>>>>>> parent of 3e2d5c1 (Errors for new code)
// Route::get('/home', [HomeController::class, 'index'])->name('home');
