@extends('layouts.app')

@section('title-blog')Новая дисциплина@endsection

@section('content')
    <h1>Добавление дисциплины</h1>

    <form action="{{route('form-disciplines')}}" method="POST">
        @csrf
        <label for="name">Название:</label>
        <input type="text" name="name" size="35" class="inputStyle" placeholder="Введите название дисциплины"/>
        <div style="padding:5px; text-align:center;">
            <button type="submit" class="greenBtn">Добавить</button>
        </div>
    </form>
@endsection
