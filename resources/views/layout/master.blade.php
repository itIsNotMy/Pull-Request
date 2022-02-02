<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>@yield('title')</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/blog/">

    

    <!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#7952b3">

    
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
  </head>
  <body>
  <div class="container">
    @include('layout.head')
    <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
      <a class="p-2 text-muted" href="{{ route('articles.index') }}">Главная</a>
      <a class="p-2 text-muted" href="{{ route('about') }}">О нас</a>
      <a class="p-2 text-muted" href="{{ route('contacts') }}">Контакты</a>
      <a class="p-2 text-muted" href="{{ route('news.index') }}">Новости</a>
      @can('create', App\Models\Article::class)
      <a class="p-2 text-muted" href="{{ route('articles.create') }}">Создать статью</a>
      @endcan
      <a class="p-2 text-muted" href="{{ route('admin.feedback') }}">Админ. раздел</a>
      @isset(Auth::User()->role->role)
      @component('components.administrator', ['role' =>  Auth::User()->role->role])
      @endcomponent
      @endisset
    </nav>
  </div>
  </div>
  <main class="container">
   <div class="row g-5">
   <div id="myid" class="col-md-8">
    @yield('content')
   </div>
   @section('sidebar')
    @include('layout.sidebar')
   @show
   </div>
  </main>
    @include('layout.foot')
    <script src="{{ mix('js/app.js') }}"> </script>
  </body>
</html>