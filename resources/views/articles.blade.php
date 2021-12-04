@extends('layout.master')
@section('title', 'Детальная страница')
@section('content')
    <h2 class="blog-post-title">{{ $article->title }}</h2>
    <p class="blog-post-meta">{{ $article->text }}</p>
    <p class="blog-post-meta">{{ $article->datePublished }}</p>
    @if ($article->comment->isNotEmpty())
        <h2 class="blog-post-title">Коментарии</h2>
        @foreach ($article->comment as $comments)
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
    @can('update', $article)
        @if(Auth::User()->role->role == 'administrator')
            @component('components.administrator', ['role' =>  Auth::User()->role->role])
            @endcomponent
        @else
            <a href="{{ route('articles.edit', $article) }}">Редактировать</a></h2>
        @endif    
    @endcan
    @if($errors->count())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('comment') }}">
    @csrf
        <div class="mb-3">
            <label class="form-label">Ваш комментарий</label>
            <textarea rows="6" cols="15" wrap="hard" type="text" class="form-control" name="text"></textarea>
        </div>
        <input type="hidden" name="article" value=" {{ $article->id }} "></input>
        <button type="submit" class="btn btn-primary">Оставить комментарий</button>
    </form>
    
@endsection
