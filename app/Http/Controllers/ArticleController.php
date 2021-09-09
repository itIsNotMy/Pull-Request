<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Carbon\Carbon;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::whereNotNull('datePublished')->latest()->get();

        return view('welcome', compact('articles'));
    }

    public function show(Article $articles)
    {
        return view('articles', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function about()
    {
        return view('about');
    }

    public function store()
    {
        $valArray = FormRequest::requestHandler(request());

        Article::create($valArray);

        return redirect(route('index'));
    }
    
    public function edit (Article $articles)
    {
        return view('articles.edit', compact('articles'));
    }
    
    public function update(Article $articles)
    {
        $valArray = FormRequest::requestHandler(request(), $articles);

        $articles->update($valArray);

        return redirect(route('index'));
    }
    
    public function destroy(Article $articles)
    {
        $articles->delete();

        return redirect(route('index'));
    }
}
