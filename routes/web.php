<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TagsController;

Route::get('/articles/tags/{tag}', [TagsController::class, 'index'])->name('articles.tags');

Route::get('/', [ArticleController::class, 'index']);

Route::resource('/articles', 'App\Http\Controllers\ArticleController');

Route::get('/about', [ArticleController::class, 'about'])->name('about');

Route::get('/contacts', [ContactController::class, 'contacts'])->name('contacts');

Route::post('/contacts', [ContactController::class, 'store']);

Route::get('/admin/feedback', [ContactController::class, 'adminFeedback'])->name('admin.feedback');
