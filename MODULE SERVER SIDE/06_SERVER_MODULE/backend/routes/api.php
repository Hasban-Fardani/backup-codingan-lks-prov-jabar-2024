<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdministratorsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GameController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::post('auth/signin', [AuthController::class, 'signin']);
    Route::post('auth/signup', [AuthController::class, 'sigup']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('auth/signout', [AuthController::class, 'signout']);

        Route::post('/games/{game}/upload', [GameController::class, 'upload']);
        Route::apiResource('/games',GameController::class);
        Route::middleware('abilities:admin')->group(function () {
            Route::get('/admins', AdministratorsController::class);
            Route::get('/users/{user:username}', [UserController::class, 'show']);
            Route::apiResource('/users', UserController::class)
                ->except(['show']);
        });
    });
});
