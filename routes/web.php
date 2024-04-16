<?php

use App\Http\Controllers\article\ArticleController;
use App\Http\Controllers\comment\CommentController;
use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
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

// get article
Route::get('/articles/detail/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');
// delete article
Route::get('/articles/delete/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy')->middleware('auth');

// create form
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
// create article
Route::post('/articles/store', [ArticleController::class, 'store'])->name('articles.store');

// edit form
Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
// update article
Route::match(['put', 'patch'], '/articles/update/{article}', [ArticleController::class, 'update'])->name('articles.update');

// add new comment
Route::post('/articles/detail/{article:slug}/comments/add', [CommentController::class, 'create'])->name("comments.create");

// delete comment
Route::get('/articles/detail/{article}/comments/{comment}/delete', [CommentController::class, 'delete'])->name("comments.delete");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('test', function () {
    $comments = new Comment();
    dd($comments->find(2)->article);
});
