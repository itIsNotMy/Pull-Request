@extends('layout.master')
@section('title', 'Создать статью')
@section('content')
@include('layout.form', ['action' => route('articles.index'), 'button' => 'Создать', 'method' => 'POST', 'tags' => $tags])
@endsection