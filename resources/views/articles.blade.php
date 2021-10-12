@extends('layout.master')
@section('title', 'Детальная страница')
@section('content')
    <h2 class="blog-post-title">{{ $article->title }}</h2>
    <p class="blog-post-meta">{{ $article->text }}</p>
    <p class="blog-post-meta">{{ $article->datePublished }}</p>
    @if(!empty(Auth::user()->id) && Auth::user()->id == $article->owner_id)
        <a href="{{ route('articles.edit', $article) }}">Редактировать</a></h2>
    @endif
@endsection