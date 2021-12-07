@extends('layout.master')
@section('title', 'Главная')
@section('content')
@if(\Auth::check())
@endif
<h3 class="pb-4 mb-4 fst-italic border-bottom">Задания</h3>
    @foreach ($articles as $article)
        <h2 class="blog-post-title"><a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></h2>
        <p class="blog-post-meta">{{ $article->description }}</p>
        <p class="blog-post-meta">{{ $article->datePublished }}</p>
            @if ($article->tags->isNotEmpty())
                @foreach ($article->tags as $tag)
                    <p class="blog-post-meta">{{ $tag->title }}</p>
                @endforeach
            @endif
    @endforeach
    <p class="blog-post-meta"> {{ $articles->links() }} </p>
@endsection
