@extends('layout.master')
@section('title', 'Редактировать')
@section('content')
@include('layout.form', ['action'=>route('articles', $articles->code), 'button'=>'Изменить', 'method'=>'PATCH'])
<form method="post" action="{{ route('articles', $articles->code) }}">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Удалить</button>
</form>
@endsection