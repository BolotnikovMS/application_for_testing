@extends('layouts.app')

@section('title-blog')Добавить вопросы@endsection

@section('content')
    <h1>Загрузка ответов (Тест)</h1>
    <div>
        <p>Данная таблица предназначена для загрузки группы ответов.</p>
        <p>ID вопроса можно узнать - <a href="{{ route('question') }}" target="_blank"><ins>тут.</ins></a></p>
    </div>
    <div id="spreadsheetAnswers"></div>
    <div style="padding:5px; text-align:center;">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <input id="btnSaveAnswers" class="button" style="text-align:center;" value="Сохранить" />
    </div>
    <script src="/js/jquery-3.5.1.min.js"></script>
    <script src="/js/loadingAnswers.js"></script>
@endsection
