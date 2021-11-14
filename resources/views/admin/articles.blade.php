@extends('layout.master')
@section('title', 'Детальная страница')
@section('content')
    <h2 class="blog-post-title">{{ $article->title }}</h2>
    <p class="blog-post-meta">{{ $article->text }}</p>
    <p class="blog-post-meta">{{ $article->datePublished }}</p>
    @can('update', $article)
        <a href="{{ route('articles.edit', $article) }}">Редактировать</a></h2>   
    @endcan
@endsection