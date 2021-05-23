@extends('layouts.app')

@section('title-blog')Добавить вопрос@endsection

@section('content')
    <h1>Добавление вопроса к теме</h1>
    <form action="{{ route('form-question') }}" method="POST" name="main" id="main">
        @csrf
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
            @foreach($dataTopic as $elmTopic)
                <option class="optionElem hidden" data-disc="{{ $elmTopic->id_discipline }}" value="{{ $elmTopic->id }}">{{ $elmTopic->name }}</option>
            @endforeach
        </select>
        <label for="grelec">Группа по ЭБ:</label>
        <select name="grelec" id="grelec" class="inputStyle">
            <option value="0">Без группы</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <input name="count_data" id="count_data" type="hidden" value="0">
        <input name="count_data_new" id="count_data_new" type="hidden" value="0">
        <label for="description">Формулировка вопроса:</label>
        <textarea name="description" cols="35" rows="5" class="inputStyle"></textarea>
        <div style="padding:5px; text-align:left;">
            <input id="addBtn" type="button" value="Добавить ответ" class="button" onclick="addInputAnswer();">&nbsp;&nbsp;&nbsp;
            <input id="delBtn" type="button" value="Удалить ответ" class="button" onclick="removeInputAnswer()">
            <div id="answers"></div>
        </div>

        <div style="padding:5px; text-align:center;">
            <input id="formSub" type="button" class="greenBtn" value="Сохранить вопрос" onclick="formSubmit()">
        </div>
    </form>

    <script src="/js/api.js"></script>
    <script src="/js/filterDiscTopic.js"></script>
@endsection
