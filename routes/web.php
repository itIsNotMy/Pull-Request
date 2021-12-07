<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsController;

Route::resource('/news', 'App\Http\Controllers\NewsController');

Route::post('/comment', [CommentController::class, 'create'])->name('comment');

Route::get('/articles/tags/{tag}', [TagsController::class, 'index'])->name('articles.tags');

Route::get('/', [ArticleController::class, 'index']);

Route::get('/admin/articles/{article}', [ArticleController::class, 'adminedit'])->name('admin.article');

Route::get('/admin/adminpage', [ArticleController::class, 'adminpage'])->name('adminpage');

Route::resource('/articles', 'App\Http\Controllers\ArticleController');

Route::get('/about', [ArticleController::class, 'about'])->name('about');

Route::get('/contacts', [ContactController::class, 'contacts'])->name('contacts');

Route::post('/contacts', [ContactController::class, 'store']);

Route::get('/admin/feedback', [ContactController::class, 'adminFeedback'])->name('admin.feedback');

Auth::routes();
