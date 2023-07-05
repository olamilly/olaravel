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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/create', [App\Http\Controllers\Api\apiAuthController::class, 'create'])->name("create");
    Route::get('/list', [App\Http\Controllers\Api\apiAuthController::class, 'read'])->name("list");
    Route::post('/update', [App\Http\Controllers\Api\apiAuthController::class, 'update'])->name("update");
    Route::post('/delete', [App\Http\Controllers\Api\apiAuthController::class, 'delete'])->name("delete");
});


Route::get("/","App\Http\Controllers\Api\apiAuthController@index");
Route::post("register","App\Http\Controllers\Api\apiAuthController@register");
Route::post("login","App\Http\Controllers\Api\apiAuthController@login");