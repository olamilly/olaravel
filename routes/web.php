<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\admin;

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

Route::group(['middleware' => ['auth', 'admin']], function() {
    Route::get('/admin', [App\Http\Controllers\adminController::class, 'index'])->name('admin');
    Route::get('/admin/users', [App\Http\Controllers\adminController::class, 'users'])->name('userlist');
    Route::get('/admin/items', [App\Http\Controllers\adminController::class, 'items'])->name('itemlist');
    Route::get('/admin/userdetails/{id}', [App\Http\Controllers\adminController::class, 'userdetails'])->name('userdetails');
});

Route::group(['middleware' => ['auth']], function() {
    
    Route::get('/form', [App\Http\Controllers\firstController::class, "form"])->name("form");
    Route::post('/successful', [App\Http\Controllers\firstController::class, "successful"])->name("successful");
    Route::post('/delete', [App\Http\Controllers\firstController::class, "delete"])->name("delete");
    Route::get('/edit/{id}', [App\Http\Controllers\firstController::class, "edit"])->name("edit");
    Route::post('/updated', [App\Http\Controllers\firstController::class, "update"])->name("updated");

    Route::get('/user', [App\Http\Controllers\webUserController::class, "read"])->name("profile");
    Route::get('/user/edituser/{id}', [App\Http\Controllers\webUserController::class, "editpage"])->name("edituser");
    Route::post('/user/updateuser', [App\Http\Controllers\webUserController::class, "update"])->name("updateuser");
    Route::post('/user/deleteuser', [App\Http\Controllers\webUserController::class, "delete"])->name("deleteuser");
    Route::post('/user/deleteadmin', [App\Http\Controllers\webUserController::class, "deleteadmin"])->name("deleteadmin")->middleware("admin");
  });


