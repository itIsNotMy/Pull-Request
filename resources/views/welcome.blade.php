@extends('layout.master')
@section('title', 'Главная')
@section('content')
<h3 class="pb-4 mb-4 fst-italic border-bottom">Задания</h3>
       @foreach ($articles as $article)
       <h2 class="blog-post-title"><a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></h2>
       <p class="blog-post-meta">{{ $article->description }}</p>
       <p class="blog-post-meta">{{ $article->datePublished }}</p>
       @endforeach
@endsection