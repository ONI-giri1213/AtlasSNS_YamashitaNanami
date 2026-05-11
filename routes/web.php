<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowsController;

use Illuminate\Support\Facades\Route;

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



require __DIR__ . '/auth.php';

//ミドルウェアをまとめる
Route::middleware('auth')->group(function () {

    //ログイン後のルーティング
    Route::get('/top', [PostsController::class, 'index']);

    //投稿後のルーティング
    Route::post('/post', [PostsController::class, 'postCreate']);

    //編集のルーティング
    Route::post('/post/{id}/update', [PostsController::class, 'update']);

    //削除のルーティング
    Route::post('/post/{id}/delete', [PostsController::class, 'delete']);

    Route::get('/profile', [ProfileController::class, 'profile']);

    Route::post('/profile/{id}', [ProfileController::class, 'profile']);

    //検索のルーティング
    Route::get('/search', [UsersController::class, 'search']);

    //フォローのルーティング
    Route::post('/follow/{id}', [FollowsController::class, 'follow']);

    //フォロー解除のルーティング
    Route::post('/unfollow/{id}', [FollowsController::class, 'unfollow']);

    Route::get('/follow-list', [FollowsController::class, 'followList']);

    Route::get('/follower-list', [FollowsController::class, 'followerList']);

//->middleware('auth');
});

//ログアウト処理
Route::get('/logout', [UsersController::class, 'logout'])->name('logout');
