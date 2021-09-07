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
        return request()->method();
        $valArray = $this->validate(request(), [
                        'code' => 'alpha_dash|unique:articles',
                        'title' => 'required|between:5,100',
                        'description' => 'required|max:255',
                        'text' => 'required',
                        ]);

        if (request()->input('checkbox') !== null) {
            $valArray += ['datePublished' => Carbon::now()];
        }

        Article::create($valArray);

        return redirect(route('index'));
    }
}
