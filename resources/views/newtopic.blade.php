@extends('layouts.app')

@section('title-blog')Добавить тему@endsection

@section('content')
    <h1>Добавление темы</h1>

    <form action="{{route('form-topic')}}" method="POST">
        @csrf

        <label for="name">Название:</label>
        <input type="text" name="name" class="inputStyle" placeholder="Введите название темы"/>
        <label for="discipline">Дисциплина:</label>
        <select name="discipline" class="inputStyle" required>
            <option disabled selected>Выберите дисциплину</option>
            @foreach($disc as $elmDisc)
                <option value="{{ $elmDisc->id }}">{{ $elmDisc->nameDisc }}</option>
            @endforeach
        </select>
        <label>Описание темы:</label>
        <textarea name="description" cols="75" rows="10" class="inputStyle" placeholder="Введите описание темы"></textarea>
        <div style="padding:5px; text-align:center;">
            <button type="submit" class="greenBtn">Добавить</button>
        </div>
    </form>
@endsection
