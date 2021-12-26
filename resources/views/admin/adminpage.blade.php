@extends('layout.master')
@section('title', 'Главная')
@section('content')
<h3 class="pb-4 mb-4 fst-italic border-bottom">Админнистраторский раздел</h3>
<a href="{{ route('admin.reports') }}">Отчеты</a>
<h3 class="blog-post-title">Статьи</h3>
       @foreach ($articles as $article)
            <h2 class="blog-post-title"><a href="{{ route('admin.article', $article) }}">{{ $article->title }}</a></h2>
            <p class="blog-post-meta">{{ $article->description }}</p>
            <p class="blog-post-meta">{{ $article->datePublished }}</p>
                @if ($article->tags->isNotEmpty())
                    @foreach ($article->tags as $tag)
                        <p class="blog-post-meta">{{ $tag->title }}</p>
                    @endforeach
                @endif
       @endforeach
       <p class="blog-post-meta"> {{ $articles->links() }} </p>
       <h3 class="blog-post-title">Новости</h3>
       @foreach ($news as $oneNews)
            <h2 class="blog-post-title"><a href="{{ route('news.show', $oneNews) }}">{{ $oneNews->title }}</a></h2>
            <p class="blog-post-meta">{{ $oneNews->description }}</p>
       @endforeach
       <p class="blog-post-meta"> {{ $news->links() }} </p>
@endsection
