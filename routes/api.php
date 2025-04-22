<?php

use App\Enums\TokenAbilityEnum;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::pattern('id', '\d+');
Route::pattern('hash', '[a-z0-9]+');
Route::pattern('hex', '[a-f0-9]+');
Route::pattern('uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');
Route::pattern('base', '[a-zA-Z0-9]+');
Route::pattern('slug', '[a-z0-9-]+');
Route::pattern('username', '[a-z0-9_-]{3,16}');

Route::prefix('auth')->middleware('api')->group(function () {

    Route::middleware('guest:sanctum')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('me', [AuthController::class, 'me']);

        Route::middleware('ability:' . TokenAbilityEnum::ISSUE_ACCESS_TOKEN->value)->group(function () {
            Route::post('refresh-token', [AuthController::class, 'refreshToken']);
        });
        
        Route::post('logout', [AuthController::class, 'logout']);
    });
});


