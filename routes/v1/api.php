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


/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::apiResource('user', \App\Http\Controllers\Api\v1\UserController::class);
Route::apiResource('task', \App\Http\Controllers\Api\v1\TaskController::class)->except('create');
Route::middleware(['throttle:task-store'])->group(function () {
    Route::post('task', [\App\Http\Controllers\Api\v1\TaskController::class, 'store']);
});



Route::post('task/{task}/user/add/{user}', [\App\Http\Controllers\Api\v1\TaskUserController::class, 'add'])->where('user', '^\d+$');
Route::post('task/{task}/user/remove/{user}', [\App\Http\Controllers\Api\v1\TaskUserController::class, 'remove'])->where('user', '^\d+$');

