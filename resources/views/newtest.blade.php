@extends('layouts.app')

@section('title-blog')Добавить тест@endsection

@section('content')
    <h1>Добавление нового теста</h1>

    <form action="{{route('form-test')}}" method="POST">
        @csrf

        <div style="margin:10px 8px auto;">
            <label for="discipline">Дисциплина:</label>
            <select name="discipline" id="discipline" class="inputStyle">
                <option>Выберите дисциплину</option>
                @foreach($dataDisc as $elemDisc)
                    <option value="{{ $elemDisc->id }}">{{ $elemDisc->nameDisc }}</option>
                @endforeach
            </select>
            <label for="topic">Тема:</label>
            <select name="topic" id="topic" class="inputStyle" multiple>
                <option disabled>Выберите тему</option>
                @foreach($dataTopic as $elemTopic)
                    <option class="optionElem hidden" data-disc="{{ $elemTopic->id_discipline }}" value="{{ $elemTopic->id }}">{{ $elemTopic->name }}</option>
                @endforeach
            </select>
            <label for="name">Название теста:</label>
            <input name="name" type="text" class="inputStyle" placeholder="Введите название теста">
            <label for="author">Автор:</label>
            <input name="author" type="text" class="inputStyle" placeholder="Введите автора">
            <label for="number">Количество вопросов в тесте:</label>
            <input name="number" type="text" class="inputStyle" placeholder="Введите количество вопросов в тесте">
            <label for="testtime">Время на тест:</label>
            <input name="testtime" id="testtime" type="text" class="inputStyle" placeholder="Введите время на тест">
            <label for="group">Тест для групп:</label>
            <select name="group" class="inputStyle">
                <option>Выберите группу</option>
                @foreach($dataGroup as $elemGroup)
                    <option value="{{ $elemGroup->id }}">{{ $elemGroup->name }}</option>
                @endforeach
            </select>
            <label for="access">Доступ к тесту:</label>
            <select name="access" class="inputStyle">
                <option value="1">Открыт</option>
                <option value="0">Закрыт</option>
            </select>
            <div style="padding:5px; text-align:center;">
                <input type="submit" value="Добавить тест" class="greenBtn">
            </div>
        </div>
    </form>

    <script src="/js/filterDiscTopic.js"></script>
@endsection
