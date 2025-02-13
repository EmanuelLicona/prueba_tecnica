<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::view('/login', 'login')->name('login');

// proteger todas las rutas con el middleware
Route::middleware('auth')->group(function () {
  Route::view('/', 'index')->name('index');

  Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
  Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
  Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
  Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
  Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
  Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
});




Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::post('/user/executeLogin', [UserController::class, 'executeLogin'])->name('executeLogin');
