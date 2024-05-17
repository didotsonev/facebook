<?php

use App\Http\Controllers\Api\PostApiController;
use App\Http\Controllers\Api\UserApiController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserApiController::class);
Route::apiResource('posts', PostApiController::class)->only(['index', 'show']);
