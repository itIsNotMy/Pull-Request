<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ReportsController;

Route::resource('/news', 'App\Http\Controllers\NewsController');

Route::post('/comment/article/{article}', [ArticleController::class, 'creatorComment'])->name('commentArticle');

Route::post('/comment/news/{news}', [NewsController::class, 'creatorComment'])->name('commentNews');

Route::get('/articles/tags/{tag}', [TagsController::class, 'index'])->name('articles.tags');

Route::get('/', [ArticleController::class, 'index']);

Route::get('/admin/articles/{article}', [ArticleController::class, 'adminedit'])->name('admin.article');

Route::get('/admin/adminpage', [ArticleController::class, 'adminpage'])->name('adminpage');

Route::resource('/articles', 'App\Http\Controllers\ArticleController');

Route::get('/about', [ArticleController::class, 'about'])->name('about');

Route::get('/contacts', [ContactController::class, 'contacts'])->name('contacts');

Route::post('/contacts', [ContactController::class, 'store']);

Route::get('/admin/feedback', [ContactController::class, 'adminFeedback'])->name('admin.feedback');

Route::get('/admin/reports', [ReportsController::class, 'index'])->name('admin.reports');

Route::post('/admin/reports', [ReportsController::class, 'reports']);

Auth::routes();

Route::get('/jjj', function(){ event(new \App\Events\test('13223123')); });

Route::get('/test', function(){

    $portalStatistics = 'всего статей ' . \App\Models\Article::count() . '</br>';

    $portalStatistics .= 'всего новостей ' . \App\Models\News::count() . '</br>';

    $userArticlesBig = 'Самый большой писака: ' . \App\Models\User::withCount('articles')->orderByRaw('articles_count desc')->limit(1)->value('name') . '</br>';

    $getFrequentlyChangingArticle = \App\Models\Article::withCount('history')->orderByRaw('history_count desc')->first();

    $portalStatistics .= 'Часто меняемая статья: ' .  $getFrequentlyChangingArticle->title . " <a href=" . route('articles.show', $getFrequentlyChangingArticle->code) . " >Сылка</a>  </br>";

    $getMostDiscussedArticle = \App\Models\Article::withCount('comment')->orderByRaw('comment_count desc')->first();

    $portalStatistics .= 'Самая обсуждаемая: ' . $getMostDiscussedArticle->title . " <a href=" . route('articles.show', $getMostDiscussedArticle->code) . " >Сылка</a>  </br>";

    $portalStatistics .= 'Среднее количество статей у пользователей: ' . \App\Models\User::withCount('articles')->having('articles_count', '>', 2)->avg('articles_count') . '</br>';

    $maxArticleText = \App\Models\Article::selectRaw('code, title, text, LENGTH(text) as length_article')->groupBy('text', 'code', 'title')->orderByRaw('length_article asc')->first();

    $portalStatistics .= 'Самоя маленькая статья: ' .  $maxArticleText->title . " <a href=" . route('articles.show', $maxArticleText->code) . " >Сылка</a> Размер в символах: " . $maxArticleText->length_article . "</br>";

    $minArticleText = \App\Models\Article::selectRaw('code, title, text, LENGTH(text) as length_article')->groupBy('text', 'code', 'title')->orderByRaw('length_article desc')->first();

    $portalStatistics .= 'Самоя большая статья: ' .  $minArticleText->title . " <a href=" . route('articles.show', $minArticleText->code) . " >Сылка</a> Размер в символах: " . $minArticleText->length_article . "</br>";

    return $portalStatistics;
});
