@extends('layouts.app')

@section('title-block')Поиск одежды по тегам@endsection

@section('content')
<form action="{{ route('tags-search') }}" method="get" class="d-flex flex-column ">

    @csrf

    <div class="form-group mx-3">
        <h3>Выбрать тэги</h3>
    </div>

    <div class="form-groups d-flex justify-content-center">
        @foreach($data as $tag)
        <div class="form-group w-10 mx-3">
            <label for="{{ $tag->id }}">#{{ $tag->name }}</label>
            <input type="checkbox" name="{{ $tag->id }}" class="form-control">
        </div>
        @endforeach
    </div>

    <div class="form-group mx-3">
        <h3>Исключить тэги</h3>
    </div>

    <div class="form-groups d-flex justify-content-center">
        @foreach($data as $tag)
        <div class="form-group w-10 mx-3">
            <label for="{{ $tag->id }}">#{{ $tag->name }}</label>
            <input type="checkbox" name="exclude-{{ $tag->id }}" class="form-control">
        </div>
        @endforeach
    </div>

    <div class="form-group w-10 mx-3">
        <input type="submit" value="Поиск" class="btn btn-success">
    </div>
</form>
@endsection