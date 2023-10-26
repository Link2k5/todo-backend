<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Login
Route::post('login', \App\Http\Controllers\Auth\LoginController::class);

Route::prefix('tasks')
    ->middleware('auth:sanctum')
    ->group(function() {
        Route::get('/', [\App\Http\Controllers\TasksController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\TasksController::class, 'store']);
    });
