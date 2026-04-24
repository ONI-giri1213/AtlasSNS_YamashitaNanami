<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    //ログインのルーティング
    Route::post('/login', [UsersController::class, 'login']);
    Route::get('/login', [UsersController::class, 'showLoginForm'])
    ->name('login');

    //新規追加のルーティング
    Route::post('/user/create', [UsersController::class, 'userCreate']);
    //新規追加後画面のルーティング
    Route::get('/added', function () {
        return view('auth.added');
    });

    Route::get('login', [AuthenticatedSessionController::class, 'create']);
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('register', [RegisteredUserController::class, 'create']);
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('added', [RegisteredUserController::class, 'added']);
    Route::post('added', [RegisteredUserController::class, 'added']);

});
