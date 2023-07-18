<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\apinotforyou;

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

//User CRUD group
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [App\Http\Controllers\Api\userController::class, 'read']);//get current user details
    Route::patch('/user', [App\Http\Controllers\Api\userController::class, 'update']);//update current user details
    Route::delete('/user', [App\Http\Controllers\Api\userController::class, 'delete']);//delete current user profile
});

//Todo CRUD group
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/todo', [App\Http\Controllers\Api\todoController::class, 'create']); //add new todo item
    Route::get('/todo', [App\Http\Controllers\Api\todoController::class, 'read']); //list all todo items
    Route::patch('/todo', [App\Http\Controllers\Api\todoController::class, 'update']); //update todo item 
    Route::patch('/todo/{id}/complete', [App\Http\Controllers\Api\todoController::class, 'complete']);//mark item as completed
    Route::delete('/todo', [App\Http\Controllers\Api\todoController::class, 'delete']);//delete todo item
});

Route::post("register","App\Http\Controllers\Api\apiAuthController@register");//user signup route
Route::post("login","App\Http\Controllers\Api\apiAuthController@login");//user login route