<?php

use Illuminate\Support\Facades\Route;

Route::post('login', [App\Http\Controllers\API\Auth\Login\LoginController::class, 'login'])->withoutMiddleware(['auth:api']);
Route::post('refresh', [App\Http\Controllers\API\Auth\Login\LoginController::class, 'refresh']);
Route::post('logout', [App\Http\Controllers\API\Auth\Logout\LogoutController::class, 'logout']);