<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        $articles = \Cache::tags(['article', 'tag'])->remember('article_tag=' . $tag->title, 3600, function() use($tag) {
            return $tag->articles()->with('tags')->latest()->get();
        });

        $news =  \Cache::tags(['news', 'tag'])->remember('news_tag=' . $tag->title, 3600, function() use($tag) {
            return $tag->news()->with('tags')->latest()->get();
        });

        return view('welcome', compact('articles'), compact('news'));
    }
}
