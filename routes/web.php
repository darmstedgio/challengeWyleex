<?php

use App\Http\Controllers\EditorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\FrontNewsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ReaderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Front - Login - Register - Readers
Auth::routes();
Route::get('/', [FrontController::class, 'index'])->name('welcome');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// News Area (all news and single news)
Route::get('/news', [FrontNewsController::class, 'index'])->name('front-news.index');
Route::get('/news/{id}/{title?}', [FrontNewsController::class, 'show'])->name('front-news.show');

// Admin routes

Route::resource('admin/news', NewsController::class)->middleware('admin');
Route::resource('admin/editors', EditorController::class)->middleware('admin');
Route::resource('admin/readers', ReaderController::class)->middleware('admin');


Route::get('/php-info', function() {
   
    return phpinfo();
});
