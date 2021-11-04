@component('mail::message')
<p>Статья отредактирована</p>
<p>{{ $article->title }}</p>

<p>{{ $article->description }}</p>
<p>{{ $article->text }}</p>
<p>{{ $article->datePublished }}</p>

@component('mail::button', ['url' =>route('articles.show', $article)])
Перейти к статье
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent