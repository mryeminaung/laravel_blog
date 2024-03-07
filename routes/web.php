<?php

use App\Http\Controllers\article\ArticleController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

Route::get('/articles/detail/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/articles/delete/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles/store', [ArticleController::class, 'store'])->name('articles.store');

Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::post('/articles/store', [ArticleController::class, 'store'])->name('articles.store');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
