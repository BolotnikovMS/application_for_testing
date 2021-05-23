@extends('layouts.app')

@section('title-blog'){{ $dataTests->name }}@endsection

@section('content')
    <h1>Редактирование теста.</h1>

    <form action="{{ route('test-update-submit', $dataTests->id) }}" method="POST">
        @csrf

        <div style="margin:10px 8px auto;">
            <label for="discipline">Дисциплина:</label>
            <select name="discipline" id="discipline" class="inputStyle">
                <option disabled>Выберите дисциплину</option>
                @foreach($dataDisc as $elemDisc)
                    @if($elemDisc->id == $dataTests->id_disc)
                        <option selected value="{{ $elemDisc->id }}">{{ $elemDisc->nameDisc }}</option>
                    @else
                        <option value="{{ $elemDisc->id }}">{{ $elemDisc->nameDisc }}</option>
                    @endif
                @endforeach
            </select>
            <label for="topic">Тема:</label>
            @php
                $idTopic = '';
                foreach($dataTopicsTests as $elemDataTopicsTests) {
                    if ($elemDataTopicsTests['id_test'] == $dataTests->id) {
                        $idTopic = $elemDataTopicsTests['id_topic'];
                    }
                }
            @endphp
            <select name="topic" id="topic" class="inputStyle" multiple>
                <option disabled>Выберите тему</option>
                @foreach($dataTopic as $elemTopic)
                    @if($idTopic == $elemTopic->id)
                        <option selected class="optionElem hidden" data-disc="{{ $elemTopic->id_discipline }}" value="{{ $elemTopic->id }}">{{ $elemTopic->name }}</option>
                    @else
                        <option class="optionElem hidden" data-disc="{{ $elemTopic->id_discipline }}" value="{{ $elemTopic->id }}">{{ $elemTopic->name }}</option>
                    @endif
                @endforeach
            </select>
            <label for="name">Название теста:</label>
            <input name="name" type="text" class="inputStyle" value="{{ $dataTests->name }}">
            <label for="author">Автор:</label>
            <input name="author" type="text" class="inputStyle" value="{{ $dataTests->author }}">
            <label for="number">Количество вопросов в тесте:</label>
            <input name="number" type="text" class="inputStyle" value="{{ $dataTests->number }}">
            <label for="testtime">Время на тест:</label>
            <input name="testtime" id="testtime" type="text" class="inputStyle" value="{{ $dataTests->testtime }}">
            <label for="group">Тест для групп:</label>
            <select name="group" class="inputStyle">
                <option disabled>Выберите группу</option>
                @foreach($dataGroup as $elemGroup)
                    @if($dataTests->id_group_test == $elemGroup->id)
                        <option selected value="{{ $elemGroup->id }}">{{ $elemGroup->name }}</option>
                    @else
                        <option value="{{ $elemGroup->id }}">{{ $elemGroup->name }}</option>
                    @endif
                @endforeach
            </select>
            <label for="access">Доступ к тесту:</label>
            <select name="access" class="inputStyle">
                @if($dataTests->status == 1)
                    <option selected value="1">Открыт</option>
                    <option value="0">Закрыт</option>
                @else
                    <option value="1">Открыт</option>
                    <option selected value="0">Закрыт</option>
                @endif
            </select>
            <div style="padding:5px; text-align:center;">
                <input type="submit" value="Сохранить" class="greenBtn">
            </div>
        </div>
    </form>

    <script src="/js/updateTopic.js"></script>
@endsection
