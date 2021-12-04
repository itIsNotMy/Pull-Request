@extends('layout.master')
@section('title', 'Создать статью')
@section('content')
@include('layout.news.form', ['action' => route('news.store'), 'button' => 'Создать', 'method' => 'POST', 'title' => 'Создание'])
@endsection