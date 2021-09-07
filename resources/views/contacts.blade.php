@extends('layout.master')
@section('title', 'Форма обратной связи')
@section('content')
<h3 class="pb-4 mb-4 fst-italic border-bottom">Отправить Сообщение</h3>
@if($errors->count())
<div class="alert alert-danger mt-4">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form method="post" action="{{ route('contacts') }}">
@csrf
  <div class="mb-3">
    <label class="form-label">emil</label>
    <input type="text" class="form-control" name="email" value="{{ old('email') }}">
  </div>
  <div class="mb-3">
    <label class="form-label">message</label>
    <textarea type="text" class="form-control" name="message" rows="3">{{ old('message') }}</textarea>
  </div>
  <button type="submit" class="btn btn-primary">Отправить</button>
</form>
@endsection