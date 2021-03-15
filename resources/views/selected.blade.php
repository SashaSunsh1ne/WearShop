@extends('layouts.app')

@section('title-block')Поиск одежды по тегам@endsection

@section('content')
@if($data != null)
@foreach($data as $item)
<h1>{{ $item->name }}</h1>
<div class="alert alert-info">
    <h3>Номер: {{ $item->id }}, Количество просмотров: {{ $item->show_count }}</h3>
</div>
@endforeach
@else
<h1>Ничего не найдено</h1>
<div class="alert alert-info">
    <h3>:(</h3>
</div>
@endif
@endsection