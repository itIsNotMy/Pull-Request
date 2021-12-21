@extends('layout.master')
@section('title', 'Детальная страница')
@section('content')
    <h2 class="blog-post-title">{{ $news->title }}</h2>
    <p class="blog-post-meta">{{ $news->description }}</p>
    <p class="blog-post-meta">{{ $news->text }}</p>
    @can('viewAny', App\Model\News::class)
    <a class="p-2 text-muted" href="{{ route('news.edit', $news) }}">Изменить Новость</a>
    @endcan
    @if ($news->comment->isNotEmpty())
        <h2 class="blog-post-title">Коментарии</h2>
        @foreach ($news->comment as $comments)
            <figure>
                <blockquote class="blockquote">
                    <p>{{ $comments->user->name }}: {{ $comments->text }}</p>
                </blockquote>
            <figcaption class="blockquote-footer">
                    <cite title="Source Title">{{ $comments->created_at }}</cite>
            </figcaption>
            </figure>
        @endforeach
    @endif
@component('components.comment', ['obj' => $news, 'action' => route('commentNews', $news)])
@endcomponent
@endsection
