<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\MyFormRequest;
use Carbon\Carbon;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::whereNotNull('datePublished')->latest()->get();

        return view('welcome', compact('articles'));
    }

    public function show(Article $article)
    {
        return view('articles', compact('article'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function about()
    {
        return view('about');
    }

    public function store(MyFormRequest $request)
    {
        $valArray = $request->validated();

        if (request()->checkbox !== null) {
            $valArray += ['datePublished' => Carbon::now()];
        }

        Article::create($valArray);

        return redirect(route('articles.index'));
    }
    
    public function edit (Article $article)
    {
        return view('edit', compact('article'));
    }
    
    public function update(MyFormRequest $request, Article $article)
    {
        $valArray = $request->validated();

        if (request()->checkbox !== null) {
            $valArray += ['datePublished' => Carbon::now()];
        }

        $article->update($valArray);

        return redirect(route('articles.index'));
    }
    
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect(route('articles.index'));
    }
}
