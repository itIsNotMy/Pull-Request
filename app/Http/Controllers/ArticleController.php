<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use App\Http\Requests\PostingRequestAndUpdatingArticles;
use Carbon\Carbon;

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
        $tags = Tag::all();

        return view('articles.create', compact('tags'));
    }

    public function about()
    {
        return view('about');
    }

    public function store(PostingRequestAndUpdatingArticles $request)
    {
        $article = Article::create($request->validated());

        foreach ($request->request as $key => $val) {
            if ($val == 'on') {
               $arrayTagsTitle[$key] = $key;
            } else if (empty($arrayTagsTitle)) {
                $arrayTagsTitle = [];
            }
        }

        $tagsRequest = collect($arrayTagsTitle)->keyBy(function($key){return $key;});
        
        app('TagsSynchronizer')->sync($tagsRequest, $article);
        
        return redirect(route('articles.index'));
    }
    
    public function edit (Article $article)
    {
        $tagsAll = Tag::all()->keyBy(function($val){return $val->title;});

        $articleTags = ($article->tags)->keyBy(function($val){return $val->title;});

        $tags = $tagsAll->diffKeys($articleTags);

        return view('edit', compact('article'), compact('tags'));
    }
    
    public function update(PostingRequestAndUpdatingArticles $request, Article $article)
    {   
        $article->update($request->validated());

        foreach ($request->request as $key => $val) {
            if ($val == 'on') {
               $arrayTagsTitle[$key] = $key;
            } else if (empty($arrayTagsTitle)) {
                $arrayTagsTitle = [];
            }
        }

        $tagsRequest = collect($arrayTagsTitle)->keyBy(function($key){return $key;});
        
        app('TagsSynchronizer')->sync($tagsRequest, $article);
        
        return redirect(route('articles.index'));
    }
    
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect(route('articles.index'));
    }
}
