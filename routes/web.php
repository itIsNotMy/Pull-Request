<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;

Route::get('/', [ArticleController::class, 'index'])->name('index');

Route::get('/articles/create', [ArticleController::class, 'create'])->name('create');

Route::get('/about', [ArticleController::class, 'about'])->name('about');

Route::post('/', [ArticleController::class, 'store'])->name('index');

Route::get('/contacts', [ContactController::class, 'contacts'])->name('contacts');

Route::post('/contacts', [ContactController::class, 'store'])->name('contacts');

Route::get('/admin/feedback', [ContactController::class, 'adminFeedback'])->name('adminFeedback');

Route::get('/articles/edit/{articles}', [ArticleController::class, 'edit'])->name('articlesEdit');

Route::get('/articles/{articles}', [ArticleController::class, 'show'])->name('articles');

Route::patch('/articles/{articles}', [ArticleController::class, 'update']);

Route::delete('/articles/{articles}', [ArticleController::class, 'destroy']);
