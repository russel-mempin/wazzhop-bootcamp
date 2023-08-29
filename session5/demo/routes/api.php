<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
// URL/api{parameter}
Route::post('register', [App\Http\Controllers\UserController::class, 'store']);
Route::get('users', [App\Http\Controllers\UserController::class, 'index']);
Route::patch('users/{user}', [App\Http\Controllers\UserController::class, 'update']);
Route::delete('users/{user}', [App\Http\Controllers\UserController::class, 'destroy']);