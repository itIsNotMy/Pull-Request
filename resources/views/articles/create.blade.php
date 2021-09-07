@extends('layout.master')
@section('title', 'Создать статью')
@section('content')
<h3 class="pb-4 mb-4 fst-italic border-bottom">Создание статьи</h3>
@if($errors->count())
<div class="alert alert-danger mt-4">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form method="post" action="{{ route('index') }}">
@csrf
  <div class="mb-3">
    <label class="form-label">Уникальный Ключ</label>
    <input type="search" class="form-control" name="code" value="{{ old('code') }}">
  </div>
  <div class="mb-3">
    <label class="form-label">Заголвок Статьи</label>
    <input type="text" class="form-control" name="title" value="{{ old('text') }}">
  </div>
    <div class="mb-3">
    <label class="form-label">Рецензия</label>
    <textarea type="text" class="form-control"  name="description" rows="3">{{ old('description') }}</textarea>
  </div>
  <div class="mb-3">
    <label class="form-label">Статья</label>
    <textarea type="text" class="form-control" name="text" rows="6">{{ old('text') }}</textarea>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" name="checkbox">
    <label class="form-check-label" for="exampleCheck1">Опубликовать</label>
  </div>
  <button type="submit" class="btn btn-primary">Отправить</button>
</form>
@endsection