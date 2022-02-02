<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\News;
use App\Models\ArticlesHistory;
use App\Models\Tag;
use App\Http\Requests\PostingRequestAndUpdatingArticles;
use Carbon\Carbon;
use App\Services\TagsSynchronizerInterface;
use App\Services\CreatorCommentArticleAndNewsInterface;
use App\Events\ArticleCreate;
use App\Events\ArticleUpdate;
use App\Events\ArticleDelete;
use App\Events\CreateNewCommentForArticle;
use App\Services\Pushall;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = \Cache::tags('article')->remember('article', 3600, function() {
            return Article::with('tags')
                                ->when(\Auth::check() && \Auth::User()->role->role == 'user', function ($query) {
                                  return $query->whereNotNull('datePublished')->orWhere('owner_id', \Auth::User()->id);
                                })->when(!(\Auth::check()), function ($query) {
                                  return $query->whereNotNull('datePublished');
                                })->latest()->paginate(10);
        });

        return view('welcome', compact('articles'));
    }

    public function show(Article $article)
    {
        $article = \Cache::tags(['comment', 'article'])->remember('comment=' . $article->id, 3600, function() use($article) {
            return $article->load(['comment', 'comment.user']);
        });

        return view('articles', compact('article'));
    }

    public function create()
    {
        $this->authorize('create', Article::class);

        $tags = \Cache::tags('tags')->remember('tags', 3600, function() {
            return Tag::all();
        });

        return view('articles.create', compact('tags'));
    }

    public function about()
    {
        return view('about');
    }

    public function store(PostingRequestAndUpdatingArticles $request, TagsSynchronizerInterface $TagsSynchronizer, Pushall $pushAll)
    {
        $article = Article::create($request->validated());

        $TagsSynchronizer->sync($request->tags, $article);

        event(new ArticleCreate($article, $pushAll));

        return redirect(route('articles.index'));
    }

    public function edit (Article $article)
    {
        $this->authorize('update', $article);

        return view('edit', compact('article'));
    }

    public function update(PostingRequestAndUpdatingArticles $request, TagsSynchronizerInterface $TagsSynchronizer, Article $article)
    {
        $article->update($request->validated());

        $TagsSynchronizer->sync($request->tags, $article);

        event(new ArticleUpdate($article));

        return redirect(route('articles.index'));
    }

    public function destroy(Article $article)
    {
        event(new ArticleDelete($article));

        $article->delete();

        return redirect(route('articles.index'));
    }

    public function adminPage()
    {
        $this->authorize('adminPages', Article::class);

        $articles = Article::with('tags')->latest()->paginate(20, ['*'], 'articles');

        $news = News::paginate(20, ['*'], 'news');

        return view('admin.adminpage', compact('articles'), compact('news'));
    }

    public function adminEdit(Article $article)
    {
        $this->authorize('adminPages', Article::class);

        return view('admin.articles', compact('article'));
    }

    public function creatorComment(Article $article, Request $request, CreatorCommentArticleAndNewsInterface $creator)
    {   
        $creator->comment($article, $request);

        event(new CreateNewCommentForArticle($article));

        return redirect()->back();
    }
}
