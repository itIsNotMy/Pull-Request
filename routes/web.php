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

Route::get('/test', function(){

    $portalStatistics = 'всего статей ' . DB::table('articles')->count() . '</br>';

    $portalStatistics .= 'всего новостей ' . DB::table('news')->count() . '</br>';

    $userArticlesBig = DB::table('articles')->selectRaw('owner_id, count(*) as user_count')->groupBy('owner_id')->orderByRaw('user_count desc')->limit(1);

    $portalStatistics .= 'Самый большой писака: ' . DB::table('users')
                                                            ->joinSub($userArticlesBig, 'find_bigUser', function ($join) {
                                                                    $join->on('users.id', '=', 'find_bigUser.owner_id');
                                                                })->value('name') . '</br>';

    $frequentlyChangingArticle = DB::table('articles_histories')->selectRaw('article_id, count(*) as article_count')->groupBy('article_id')->orderByRaw('article_count desc')->limit(1);

    $getFrequentlyChangingArticle = DB::table('articles')
                                            ->joinSub($frequentlyChangingArticle, 'find_frequentlyChangingArticle', function ($join) {
                                                $join->on('articles.id', '=', 'find_frequentlyChangingArticle.article_id');
                                            })->first();

    $portalStatistics .= 'Часто меняемая статья: ' .  $getFrequentlyChangingArticle->title . " <a href=" . route('articles.show', $getFrequentlyChangingArticle->code) . " >Сылка</a>  </br>";

    $mostDiscussedArticle = DB::table('comments')->where('commentable_type', "App\Models\Article")->selectRaw('commentable_id, count(*) as article_count')->groupBy('commentable_id')->orderByRaw('article_count desc')->limit(1);

    $getMostDiscussedArticle = DB::table('articles')
                                       ->joinSub($mostDiscussedArticle, 'find_mostDiscussedArticle', function ($join) {
                                            $join->on('articles.id', '=', 'find_mostDiscussedArticle.commentable_id');
                                        })->first();

    $portalStatistics .= 'Самая обсуждаемая: ' . $getMostDiscussedArticle->title . " <a href=" . route('articles.show', $getMostDiscussedArticle->code) . " >Сылка</a>  </br>";

    $portalStatistics .= 'Среднее количество статей у пользователей: ' . DB::table('articles')->selectRaw('owner_id, count(*) as user_count')->groupBy('owner_id')->having('user_count', '>', 1)->avg('user_count') . '</br>';

    $maxArticleText = \App\Models\Article::maxArticleText();

    $portalStatistics .= 'Самоя большая статья: ' .  $maxArticleText->title . " <a href=" . route('articles.show', $maxArticleText->code) . " >Сылка</a> Размер в символах: " . $maxArticleText->length_article . "</br>";

    $minArticleText = \App\Models\Article::minArticleText();

    $portalStatistics .= 'Самоя маленькая статья: ' .  $minArticleText->title . " <a href=" . route('articles.show', $minArticleText->code) . " >Сылка</a> Размер в символах: " . $minArticleText->length_article . "</br>";

    return $portalStatistics;
});
