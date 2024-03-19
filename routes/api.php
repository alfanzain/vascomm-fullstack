<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\Auth\RegisterController;
use \App\Http\Controllers\Api\Auth\LoginController;
use \App\Http\Controllers\Api\ProductController;
use \App\Http\Controllers\Api\UserController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')
    ->group(function () {
        Route::prefix('auth')->group(function () {
            Route::post('/register', [RegisterController::class, 'register']);
            Route::post('/login', [LoginController::class, 'login']);

            Route::middleware('auth:api')->group(function () {
                Route::post('/logout', [LoginController::class, 'logout']);
            });
        });

        Route::get('/products', [ProductController::class, 'index']);
        Route::get('/products/available', [ProductController::class, 'available']);

        Route::prefix('products')
            ->middleware('auth:api')
            ->group(function () {
                Route::get('/{product}', [ProductController::class, 'show'])
                    ->middleware('role:admin,user');
                Route::post('/', [ProductController::class, 'store'])
                    ->middleware('role:admin');
                Route::put('/{product}', [ProductController::class, 'update'])
                    ->middleware('role:admin');
                Route::delete('/{product}', [ProductController::class, 'destroy'])
                    ->middleware('role:admin');
            });

        Route::prefix('users')
            ->middleware(['auth:api', 'role:admin'])
            ->group(function () {
                Route::get('/', [UserController::class, 'index']);
                Route::get('/{user}', [UserController::class, 'show']);
                Route::post('/', [RegisterController::class, 'register']);
                Route::put('/{user}', [UserController::class, 'update']);
                Route::delete('/{user}', [UserController::class, 'destroy']);
            });
    });
