<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SpaceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/user', [UserController::class, 'index']);
Route::get('/user/{email}', [UserController::class, 'show']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::put('/user/updateMail/{email}', [UserController::class, 'updateMail']);
Route::delete('/user/{email}', [UserController::class, 'destroy']);

Route::get('/spaces/{island?}', [SpaceController::class, 'index']);
Route::get('/space/{id}', [SpaceController::class, 'show']);
Route::post('/space', [SpaceController::class, 'store']);
