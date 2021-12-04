<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

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

        return view('news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "title" => 'required',
            "description" => 'required',
            "text" => 'required',
            ]);
            
        News::create($validated);
        
        return redirect(route('news.index'));
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    public function edit(News $news)
    {
        $this->authorize('update', $news);
        
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            "title" => 'required',
            "description" => 'required',
            "text" => 'required',
            ]);
            
        $news->update($validated);
        
        return redirect(route('news.index'));
    }

    public function destroy(News $news)
    {
        $this->authorize('delete', $news);
        
        $news->delete();
         
        return redirect(route('news.index'));
    }
}
