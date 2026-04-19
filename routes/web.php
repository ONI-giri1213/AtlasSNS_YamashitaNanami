<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
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

//ログインのルーティング
Route::post('/login', [UsersController::class, 'login']);
Route::get('/login', [UsersController::class, 'showLoginForm'])
->name('login');

//ログイン後のルーティング
Route::get('/top', [PostsController::class, 'index'])
->middleware('auth');

//新規追加のルーティング
Route::post('/user/create', [UsersController::class, 'userCreate']);
//新規追加後画面のルーティング
Route::get('/added', function () {
    return view('auth.added');
});

Route::get('profile', [ProfileController::class, 'profile'])
->middleware('auth');

Route::get('search', [UsersController::class, 'index'])
->middleware('auth');

Route::get('follow-list', [PostsController::class, 'index'])
->middleware('auth');

Route::get('follower-list', [PostsController::class, 'index'])
->middleware('auth');
