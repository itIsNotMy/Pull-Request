<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use App\Http\Requests\PostingRequestAndUpdatingArticles;
use Carbon\Carbon;
use App\Services\TagsSynchronizerInterface;

class ArticleController extends Controller
{   
    public function index()
    {
        $articles = Article::with('tags')->whereNotNull('datePublished')->latest()->get();

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

        return redirect(route('articles.index'));
    }

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        $article->delete();

        return redirect(route('articles.index'));
    }
}
