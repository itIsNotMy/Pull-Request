<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Tag;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Services\TagsSynchronizerInterface;
use App\Services\CreatorCommentArticleAndNewsInterface;
use App\Events\CreateNewCommentForNews;

class NewsController extends Controller
{
    public function index()
    {
        $news = \Cache::tags('news')->remember('news', 3600, function() {
            return News::paginate(5);
        });

        return view('news', compact('news'));
    }

    public function create()
    {
        $this->authorize('create', News::class);

        $tags = \Cache::tags('tags')->remember('tags', 3600, function() {
            return Tag::all();
        });

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
        $news = \Cache::tags(['comment', 'news'])->remember('comment=' . $news->id, 3600, function() use($news) {
            return $news->load(['comment']);
        });

        return view('news.show', compact('news'));
    }

    public function edit(News $news)
    {
        $this->authorize('update', $news);
        
        return view('news.edit', compact('news'));
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

    public function creatorComment(News $news, Request $request, CreatorCommentArticleAndNewsInterface $creator)
    {        
        $creator->comment($news, $request);

        event(new CreateNewCommentForNews($news));

        return redirect()->back();
    }
}
