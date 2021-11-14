<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use App\Http\Requests\PostingRequestAndUpdatingArticles;
use Carbon\Carbon;
use App\Services\TagsSynchronizerInterface;
use App\Events\ArticleCreate;
use App\Events\ArticleUpdate;
use App\Events\ArticleDelete;

class ArticleController extends Controller
{   
    public function index()
    {

        $articles = Article::with('tags')
                                ->when(\Auth::check(), function ($query) {
                                    if(\Auth::User()->role->role == 'user') {
                                        return $query->whereNotNull('datePublished')->orWhere('owner_id', \Auth::User()->id);
                                    } else {
                                        return $query;
                                    }
                                    }, function ($query) {
                                        return $query->whereNotNull('datePublished');
                                    })->latest()->get();

        return view('welcome', compact('articles'));
    }

    public function show(Article $article)
    {
        return view('articles', compact('article'));
    }

    public function create()
    {   
        $this->authorize('create', Article::class);

        $tags = Tag::all();

        return view('articles.create', compact('tags'));
    }

    public function about()
    {   
        return view('about');
    }

    public function store(PostingRequestAndUpdatingArticles $request, TagsSynchronizerInterface $TagsSynchronizer)
    {
        $article = Article::create($request->validated());

        $TagsSynchronizer->sync($request->tags, $article);
        
        event(new ArticleCreate($article));

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
        
        $articles = Article::with('tags')->latest()->get();

        return view('admin.adminpage', compact('articles'));
    }
    
    public function adminEdit(Article $article)
    {
        $this->authorize('adminPages', Article::class);
        
        return view('admin.articles', compact('article'));
    }
}
