<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Services\TagsSynchronizerInterface;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::paginate(5);

        return view('news', compact('news'));
    }

    public function create()
    {
        $this->authorize('create', News::class);
        
        $tags = Tag::all();

        return view('news.create', compact('tags'));
    }

    public function store(NewsRequest $request, TagsSynchronizerInterface $TagsSynchronizer)
    {
        $news = News::create($request->validated());
        
        $TagsSynchronizer->sync($request->tags, $news);
        
        return redirect(route('news.index'));
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    public function edit(News $news)
    {
        $this->authorize('update', $news);
        
        $tags = Tag::all();
        
        return view('news.edit', compact('news'), compact('tags'));
    }

    public function update(NewsRequest $request, News $news, TagsSynchronizerInterface $TagsSynchronizer)
    {       
        $news->update($request->validated());
        
        $TagsSynchronizer->sync($request->tags, $news);
        
        return redirect(route('news.index'));
    }

    public function destroy(News $news)
    {
        $this->authorize('delete', $news);
        
        $news->delete();
         
        return redirect(route('news.index'));
    }
}
