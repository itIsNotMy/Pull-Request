@extends('layout.master')
@section('title', 'Детальная страница')
@section('content')
    <h2 class="blog-post-title">{{ $articles->title }}</h2>
    <p class="blog-post-meta">{{ $articles->text }}</p>
    <p class="blog-post-meta">{{ $articles->datePublished }}</p>
@endsection