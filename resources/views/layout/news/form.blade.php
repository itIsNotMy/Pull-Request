<h3 class="pb-4 mb-4 fst-italic border-bottom">{{ $title }} статьи</h3>
@if($errors->count())
<div class="alert alert-danger mt-4">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form method="post" action="{{$action}}">
@csrf
@method($method)
   <div class="mb-3">
    <label class="form-label">Заголовок</label>
    <textarea type="text" class="form-control"  name="title" rows="3">{{ old('title', $news->title ?? '') }}</textarea>
   </div>
    <div class="mb-3">
    <label class="form-label">Описание</label>
    <textarea type="text" class="form-control"  name="description" rows="3">{{ old('description', $news->description ?? '') }}</textarea>
  </div>
  <div class="mb-3">
    <label class="form-label">Новость</label>
    <textarea type="text" class="form-control" name="text" rows="6">{{  old('text', $news->text ?? '') }}</textarea>
  </div>
  <div class="mb-3 form-check">
    @if (!empty($news) && $news->tags->isNotEmpty())
    <label class="form-label">Теги статьи: </label>
    <input type="text" class="form-control" name="tags" value="{{ $news->tags->pluck('title')->implode(',') }}">
    @endif
    @if (!empty($tags) && $tags->isNotEmpty() && empty($news))
    <label class="form-label">Добавить теги: </label>
    <input type="text" class="form-control" name="tags" value="{{ $tags->pluck('title')->implode(',') ?? '' }}">
    @endif
  </div>
  <button type="submit" class="btn btn-primary">{{$button}}</button>
</form>
