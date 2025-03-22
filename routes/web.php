<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::view('/login', 'login')->name('login');
// Route::get('/register', [UserController::class, 'register'])->name('register');
// Route::post('/executeRegister', [UserController::class, 'executeRegister'])->name('executeRegister');

Route::get('/register-form', [RegisterController::class, 'form'])->name('register_form');
Route::resource('/register', RegisterController::class);

Route::middleware('auth')->group(function () {
  
  Route::get('logout', [UserController::class, 'logout'])->name('logout');

  Route::get('/', [HomeController::class, 'index'])->name('index');
  Route::get('/user', [UserController::class, 'index'])->name('user.index');
});




Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::post('/user/executeLogin', [UserController::class, 'executeLogin'])->name('executeLogin');
