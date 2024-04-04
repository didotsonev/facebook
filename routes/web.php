<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'name' => 'Facebook'
    ]);
});

//Route::get('/users', [UserController::class, 'index']);
//Route::get('/users/create', [UserController::class, 'create']);
//Route::put('/use/{user}', [UserController::class, 'update'])->name('users.update');
//Route::get('/users/{user}', [UserController::class, 'show']);
//Route::post('/users', [UserController::class, 'store']);
//Route::get('/users/{user}/edit', [UserController::class, 'edit']);
//Route::delete('/users/{user}', [UserController::class, 'destroy']);

Route::resource('users', UserController::class);
