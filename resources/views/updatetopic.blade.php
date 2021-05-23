@extends('layouts.app')

@section('title-blog'){{ $dataTopic->name }}@endsection

@section('content')
    <h1>Изменение темы.</h1>
    <form action="{{route('topic-update-submit', $dataTopic->id)}}" method="POST">
        @csrf

        <label for="name">Название:</label>
        <input type="text" name="name" class="inputStyle" value="{{ $dataTopic->name }}" placeholder="Введите название темы"/>
        <label for="discipline">Дисциплина:</label>
        <select name="discipline" class="inputStyle" required>
            <option disabled selected>Выберите дисциплину</option>
            @foreach($dataDisc as $elmDisc)
                @if($dataTopic->id_discipline == $elmDisc->id)
                    <option selected value="{{ $elmDisc->id }}">{{ $elmDisc->nameDisc }}</option>
                @else
                    <option value="{{ $elmDisc->id }}">{{ $elmDisc->nameDisc }}</option>
                @endif
            @endforeach
        </select>
        <label>Описание темы:</label>
        <textarea name="description" cols="75" rows="10" class="inputStyle"
                  placeholder="Введите описание темы">{{ $dataTopic->description }}</textarea>

        <div style="padding:5px; text-align:center;">
            <button type="submit" class="greenBtn">Сохранить</button>
        </div>
    </form>
@endsection
