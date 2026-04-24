<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', [AuthController::class , 'showLogin'])->name('login');
Route::post('/login', [AuthController::class , 'Login'])->name('auth.login');
Route::post('/logout', [AuthController::class , 'Logout'])->name('auth.logout');

Route::middleware('auth')->group(function (){
    Route::get('/dashboard' , [ArticleController::class, 'dashboard'])->name('dashboard');

    Route::get('/articles', fn() => redirect()->route('dashboard'))->name('articles.index');
    Route::get('/articles/create' , [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

    Route::get('/articles/{article}/edit' , [ArticleController::class , 'edit'])->name('articles.edit');
    Route::put('/articles/{article}' , [ArticleController::class, 'update'])->name('articles.update');
    
    Route::delete('/articles/{article}/delete' , [ArticleController::class, 'destroy'])->name('articles.delete');
    
});

// Public article view (must be after /articles/create to avoid conflict)
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show'); 