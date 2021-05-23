@extends('layouts.app')

@section('title-blog')Изменение вопроса@endsection

@section('content')
    <h1>Изменение вопроса</h1>

        <form action="{{ route('update-questions-submit', $dataQuestion->id) }}" method="POST" name="main" id="main">
            @csrf

            <label for="discipline">Дисциплина:</label>
            <select name="discipline" id="discipline" class="inputStyle">
                <option disabled>Выберите дисциплину</option>
                @foreach($dataDisc as $elemDataDisc)
                    @foreach($dataTopic as $elemDataTopic)
                    @endforeach
                        @if($elemDataDisc->id == $elemDataTopic->id_discipline & $dataQuestion->id_topic == $elemDataTopic->id)
                            <option selected value="{{ $elemDataDisc->id }}">{{ $elemDataDisc->nameDisc }}</option>
                        @else
                            <option value="{{ $elemDataDisc->id }}">{{ $elemDataDisc->nameDisc }}</option>
                        @endif
                @endforeach
            </select>
            <label for="topic">Тема:</label>
            <select name="topic" id="topic" class="inputStyle" multiple>
                <option disabled>Выберите тему</option>
                @foreach($dataTopic as $elemDataTopic)
                    @if($dataQuestion->id_topic == $elemDataTopic->id)
                        <option selected class="optionElem hiddenBtn" data-disc="{{ $elemDataTopic->id_discipline }}" value="{{ $elemDataTopic->id }}">{{ $elemDataTopic->name }}</option>
                    @else
                        <option class="optionElem hiddenBtn" data-disc="{{ $elemDataTopic->id_discipline }}" value="{{ $elemDataTopic->id }}">{{ $elemDataTopic->name }}</option>
                    @endif
                @endforeach
            </select>
            <label for="description">Формулировка вопроса:</label>
            <textarea name="description" cols="35" rows="5" class="inputStyle" required="required">{{ $dataQuestion->description }}</textarea>
            <div style="padding:5px; text-align:left;">
                <input id="addBtn" type="button" value="Добавить ответ" class="button" onclick="addInputAnswer();">&nbsp;&nbsp;&nbsp;
                <input id="delBtn" type="button" value="Удалить ответ" class="button" onclick="removeInputAnswer()">
                <div id="answers">
                @php $incAns = 1; $test = count($dataAnswers); @endphp
                <input name="count_data" id="count_data" type="hidden" value="{{ $test }}">
                <input name="count_data_new" id="count_data_new" type="hidden" value="0">
                @foreach($dataAnswers as $elemDataAnswers)
                        <input name="count_data" id="count_data" type="hidden" value="{{ $incAns }}">
                    <label>Ответ {{ $incAns }}</label>
                        <a href="{{ route('answer-delete', [$elemDataAnswers->id, $elemDataAnswers->id_question]) }}" title="Удалить">
                            <img src="{{ URL::asset('/img/delete.png') }}" alt="Удалить" class="editingImg listEditingImg">
                        </a>

                        <input class="inputStyle" type="text" name="answer_{{ $incAns }}" id="answer_{{ $incAns }}" value="{{ $elemDataAnswers->description_answer }}">
                    @if($elemDataAnswers->correct == 1)
                        <input type="checkbox" name="check_{{ $incAns }}" id="check_{{ $incAns }}" value="1" checked>
                    @else
                        <input type="checkbox" name="check_{{ $incAns }}" id="check_{{ $incAns }}" value="1">
                    @endif
                    @php $incAns++; @endphp
                @endforeach
                </div>
            </div>
            <div style="padding:5px; text-align:center;">
                <input id="formSub" type="submit" value="Сохранить" class="greenBtn" onclick="formSubmit()">
            </div>
        </form>

    <script src="/js/api.js"></script>
    <script src="/js/updateTopic.js"></script>
@endsection
