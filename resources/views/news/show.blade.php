@extends('layout.master')
@section('title', 'Детальная страница')
@section('content')
    <h2 class="blog-post-title">{{ $news->title }}</h2>
    <p class="blog-post-meta">{{ $news->description }}</p>
    <p class="blog-post-meta">{{ $news->text }}</p>
    @can('viewAny', App\Model\News::class)
    <a class="p-2 text-muted" href="{{ route('news.edit', $news) }}">Изменить Новость</a>
    @endcan
@endsection
