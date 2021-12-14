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
        <input type="hidden" name="obj" value=" {{ $news->id }} "></input>
        <input type="hidden" name="type" value=" {{ get_class($news) }} "></input>
        <button type="submit" class="btn btn-primary">Оставить комментарий</button>
    </form>
@endsection
