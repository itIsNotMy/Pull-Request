@extends('layout.master')
@section('title', 'Создать статью')
@section('content')
@include('layout.form', ['action'=>route('index'), 'button'=>'Создать', 'method'=>'POST'])
@endsection