@extends('layout.master')
@section('title', 'Главная')
@section('content')
<form method="post" action="{{ route('admin.reports') }}">
@csrf
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="Tag">
    <label class="form-check-label" for="exampleCheck1">Отчет по Тегам</label>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="Article">
    <label class="form-check-label" for="exampleCheck1">Отчет по Статьям</label>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="User">
    <label class="form-check-label" for="exampleCheck1">Отчет по Пользователям</label>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="News">
    <label class="form-check-label" for="exampleCheck1">Отчет по Новостям</label>
  </div>
  <button type="submit" class="btn btn-primary">Сформировать</button>
</form>
@endsection
