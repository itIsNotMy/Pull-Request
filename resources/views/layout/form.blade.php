<h3 class="pb-4 mb-4 fst-italic border-bottom">Изменение статьи</h3>
@if($errors->count())
<div class="alert alert-danger mt-4">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form method="post" action={{$action}}>
@csrf
@method($method)
  <div class="mb-3">
    <label class="form-label">Уникальный Ключ</label>
    <input type="search" class="form-control" name="code" value="{{ old('code', $article->code ?? '') }}">
  </div>
  <div class="mb-3">
    <label class="form-label">Заголвок Статьи</label>
    <input type="text" class="form-control" name="title" value="{{ old('title', $article->title ?? '') }}">
  </div>
    <div class="mb-3">
    <label class="form-label">Рецензия</label>
    <textarea type="text" class="form-control"  name="description" rows="3">{{ old('description', $article->description ?? '') }}</textarea>
  </div>
  <div class="mb-3">
    <label class="form-label">Статья</label>
    <textarea type="text" class="form-control" name="text" rows="6">{{  old('text', $article->text ?? '') }}</textarea>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" name="checkbox" checked="checked"">
    <label class="form-check-label" for="exampleCheck1">Опубликовать</label>
  </div>
  <button type="submit" class="btn btn-primary">{{$button}}</button>
</form>