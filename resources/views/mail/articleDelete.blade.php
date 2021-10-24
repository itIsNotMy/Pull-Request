@component('mail::message')
<p>Статья удалена</p>
<p>{{ $article->title }}</p>

<p>{{ $article->description }}</p>
<p>{{ $article->text }}</p>
<p>{{ $article->datePublished }}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent