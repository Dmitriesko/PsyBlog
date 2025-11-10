<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Website\CommentController;
use App\Http\Controllers\Website\LikeController;
use App\Http\Controllers\Website\MainController;
use App\Http\Controllers\Website\ArticleController as WebsiteArticleController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.perform');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/articles/{article}/like', [LikeController::class, 'toggle'])
    ->name('articles.like')
    ->middleware('auth');
Route::post('/articles/{article}/comment', [CommentController::class, 'store'])
    ->name('articles.comment')
    ->middleware('auth');

Route::prefix('')->group(function () {
        Route::get('/', [MainController::class, 'index'])->name('home');
        Route::get('/article', [WebsiteArticleController::class, 'index'])->name('article.index');
        Route::get('/article/{article}', [WebsiteArticleController::class, 'show'])->name('article.show');
        Route::get('/search', [WebsiteArticleController::class, 'search'])->name('article.search');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.articles.index');

    Route::prefix('articles')->group(function () {
        Route::get('/', [AdminArticleController::class, 'index'])->name('admin.articles.index');
        Route::get('/create', [AdminArticleController::class, 'create'])->name('admin.articles.create');
        Route::post('/', [AdminArticleController::class, 'store'])->name('admin.articles.store');
        Route::get('/{id}/edit', [AdminArticleController::class, 'edit'])->name('admin.articles.edit');
        Route::put('/{id}', [AdminArticleController::class, 'update'])->name('admin.articles.update');
        Route::get('/{article}', [AdminArticleController::class, 'show'])->name('admin.articles.show');
        Route::delete('/{article}', [AdminArticleController::class, 'destroy'])->name('admin.articles.destroy');
    });
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', CategoryController::class);
});




