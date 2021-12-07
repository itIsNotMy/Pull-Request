@extends('layout.master')
@section('title', 'Редактировать')
@section('content')
@include('layout.news.form', ['action'=>route('news.update', $news), 'button'=>'Изменить', 'method'=>'PATCH', 'title' => 'Изменение'])
<form method="post" action="{{ route('news.destroy', $news) }}">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Удалить</button>
</form>
@endsection