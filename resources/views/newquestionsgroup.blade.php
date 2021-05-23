@extends('layouts.app')

@section('title-blog')Добавить вопросы@endsection

@section('content')
    <h1>Загрузка вопросов (Тест)</h1>
    <div>
        <p>Данная таблица предназначена для загрузки группы вопросов.</p>
        <p>Таблица для добавления ответов <a href="{{ route('addinganswers') }}"><ins>тут.</ins></a></p>
    </div>
    <div style="display: inline-flex;">
        <label for="discipline">Дисциплина:</label>
        <select name="discipline" id="discipline" class="inputStyle">
            <option disabled selected>Выберите дисциплину</option>
            @foreach($dataDisc as $elmDisc)
                <option value="{{ $elmDisc->id }}">{{ $elmDisc->nameDisc }}</option>
            @endforeach
        </select>
        <label for="topic">Тема:</label>
        <select name="topic" id="topic" class="inputStyle">
            <option disabled selected>Выберите тему</option>
        </select>
    </div>
    <div id="message"></div>
    <div id="spreadsheetQuestions"></div>
        <div style="padding:5px; text-align:center;">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <input id="btnSaveQuestions" class="button" style="text-align:center;" value="Сохранить" />
        </div>

    <script src="/js/jquery-3.5.1.min.js"></script>
    <script src="/js/loadingQuestions.js"></script>
@endsection
