@extends('layout.master')
@section('title', 'Новости')
@section('content')
<h3 class="pb-4 mb-4 fst-italic border-bottom">Новости</h3>
    @forelse ($news as $oneNews)
        <h2 class="blog-post-title"><a href="{{ route('news.show', $oneNews) }}">{{ $oneNews->title }}</a></h2>
        <p class="blog-post-meta">{{ $oneNews->description }}</p>
    @empty
        <p class="blog-post-meta">Нет новостей</p>
    @endforelse
    @can('viewAny', App\Model\News::class)
        <a class="p-2 text-muted" href="{{ route('news.create') }}">Создать Новость</a>
    @endcan
    {{$news->links()}}
@endsection
