<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/form', [App\Http\Controllers\firstController::class, "form"])->name("form")->middleware('auth');
Route::post('/successful', [App\Http\Controllers\firstController::class, "successful"])->name("successful")->middleware('auth');
Route::get('/delete/{id}', [App\Http\Controllers\firstController::class, "delete"])->name("delete")->middleware('auth');
Route::get('/edit/{id}', [App\Http\Controllers\firstController::class, "edit"])->name("edit")->middleware('auth');
Route::post('/updated', [App\Http\Controllers\firstController::class, "update"])->name("updated")->middleware('auth');