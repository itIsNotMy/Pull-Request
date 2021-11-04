@extends('layout.master')
@section('title', 'Главная')
@section('content')
<h3 class="pb-4 mb-4 fst-italic border-bottom">Задания</h3>
    @if(Auth::check())
        @foreach ($articles as $article)
            @if ($article->datePublished != null || $article->owner_id == Auth::User()->id || Auth::User()->role->role == 'administrator')
                <h2 class="blog-post-title"><a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></h2>
                <p class="blog-post-meta">{{ $article->description }}</p>
                <p class="blog-post-meta">{{ $article->datePublished }}</p>
                @if ($article->tags->isNotEmpty())
                    @foreach ($article->tags as $tag)
                         <p class="blog-post-meta">{{ $tag->title }}</p>
                    @endforeach
                @endif
            @endif
        @endforeach
    @else
        @foreach ($articles as $article)
            @if ($article->datePublished != null)
                <h2 class="blog-post-title"><a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></h2>
                <p class="blog-post-meta">{{ $article->description }}</p>
                <p class="blog-post-meta">{{ $article->datePublished }}</p>
                @if ($article->tags->isNotEmpty())
                    @foreach ($article->tags as $tag)
                         <p class="blog-post-meta">{{ $tag->title }}</p>
                    @endforeach
                @endif
            @endif
        @endforeach
    @endif
@endsection