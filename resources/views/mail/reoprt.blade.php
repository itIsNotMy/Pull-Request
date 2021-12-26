@component('mail::message')
<p>Вот ваш отчет</p>
@foreach($reoprt as $key=>$val)
 {{$key .':'. $val }}
@endforeach

Thanks,<br>
{{ config('app.name') }}
@endcomponent