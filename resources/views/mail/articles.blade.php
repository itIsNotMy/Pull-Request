@component('mail::message')
@if($action == 'create')
<p>Создана новая статья</p>
<p>{{ $article->title }}</p>
@elseif($action == 'update')
<p>Статья отредактирована</p>
<p>{{ $article->title }}</p>
@elseif($action == 'delete')
<p>Статья удалена</p>
<p>{{ $article->title }}</p>
@endif

<p>{{ $article->description }}</p>
<p>{{ $article->text }}</p>
<p>{{ $article->datePublished }}</p>

@if($action != 'delete')
@component('mail::button', ['url' =>route('articles.show', $article)])
Перейти к статье
@endcomponent
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent