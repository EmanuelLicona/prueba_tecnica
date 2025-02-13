<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('index');
Route::view('/login', 'login')->name('login');

Route::get('/category', [CategoryController::class, 'index'])->name('category.index');