<?php

use App\Http\Controllers\Api\UserApiController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserApiController::class);
