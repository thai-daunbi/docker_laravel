<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReplyController;
=======

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
>>>>>>> parent of e8b561e (finish change laravel)

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

    // Route::post('/like', [PostController::class, 'fetchLike']);
    // Route::post('/like/{id}', [PostController::class, 'handleLike']);
    
    // Route::post('/dislike', [PostController::class, 'fetchDislike']);
    // Route::post('/dislike/{id}', [PostController::class, 'handleDislike']);

    // Route::post('/like-dislike-post', [PostController::class, 'likeDislikePost'])->name('like.dislike.post');

    Route::post('/like', 'PostController@store')->name('like.store');



    // Replies routes
    Route::prefix('/replies')->as('replies.')->group(function () {
        // store reply route
        Route::post('/{comment}', [ReplyController::class, 'store'])->name('store');
    });
});

// Route::get('/home', [HomeController::class, 'index'])->name('home');