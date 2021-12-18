@if($errors->count())
    <div class="alert alert-danger mt-4">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="post" action="{{ $action }}">
@csrf
    <div class="mb-3">
        <label class="form-label">Ваш комментарий</label>
        <textarea rows="6" cols="15" wrap="hard" type="text" class="form-control" name="text"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Оставить комментарий</button>
</form>