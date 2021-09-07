@extends('layout.master')
@section('title', 'Сообщения')
@section('content')
<h3 class="pb-4 mb-4 fst-italic border-bottom">Сообщения</h3>
<table class="table table-dark table-hover">
  <thead>
    <tr>
      <th scope="col">email</th>
      <th scope="col">message</th>
      <th scope="col">data_time</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($contacts as $contact)
    <tr>
      <th>{{ $contact->email }}</th>
      <td>{{ $contact->message }}</td>
      <td>{{ $contact->updated_at }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection