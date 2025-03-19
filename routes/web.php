<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::view('/login', 'login')->name('login');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/executeRegister', [UserController::class, 'executeRegister'])->name('executeRegister');

// registrar todas las rutas con una linea
Route::resource('/register-form', RegisterController::class);

Route::middleware('auth')->group(function () {
  Route::get('logout', [UserController::class, 'logout'])->name('logout');

  Route::get('/', [HomeController::class, 'index'])->name('index');

  Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
  Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
  Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
  Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
  Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
  Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

  Route::get('/product', [ProductController::class, 'index'])->name('product.index');
  Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
  Route::post('/product', [ProductController::class, 'store'])->name('product.store');
  Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
  Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
  Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
  Route::get('/product/category/{categoryId}', [ProductController::class, 'productByCategory'])->name('product.category');

  Route::get('/user', [UserController::class, 'index'])->name('user.index');
});




Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::post('/user/executeLogin', [UserController::class, 'executeLogin'])->name('executeLogin');
