@isset($role)
@if($role == 'administrator')
    <a class="p-2 text-muted" href="{{ route('adminpage') }}">Вот он раздел</a>
@endif
@endisset