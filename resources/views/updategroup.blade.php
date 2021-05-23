@extends('layouts.app')

@section('title-blog'){{ $group->name }}@endsection

@section('content')
    <h1>Редактирование группы.</h1>

    <form action="{{route('group-update-submit', $group->id)}}" method="POST">
        @csrf

        <label for="name">Название:</label>
        <input type="text" name="name" class="inputStyle" value="{{ $group->name }}" placeholder="Введите название группы"/>

        <div style="padding:5px; text-align:center;">
            <button type="submit" class="greenBtn">Сохранить</button>
        </div>
    </form>

@endsection
