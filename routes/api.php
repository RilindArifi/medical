<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;


Route::middleware(['auth:sanctum'])->group(function () {
    Route::controller(AuthController::class)
        ->group(function () {
            Route::post('logout', 'logout');
            Route::post('refresh', 'refresh');
        });
    Route::get('/user', function (Request $request) {
        return UserResource::make($request->user());
    });
});


Route::middleware(['guest:sanctum'])->group(function () {
    Route::controller(AuthController::class)
        ->group(function () {
            Route::post('login', 'login');
            Route::post('register', 'register');

        });
});
