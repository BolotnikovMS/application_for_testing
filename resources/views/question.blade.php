@extends('layouts.app')

@section('title-blog')Вопросы@endsection

@section('content')
    <h1>Все вопросы</h1>
    <div style="display: inline-flex;">
        <a class="greenBtn addBtnQuestion" href="{{route('newquestion')}}">Добавить вопрос</a>
        <label for="disciplines">Дисциплина:</label>
        <select name="disciplines" id="disciplines" class="inputStyle inputFilter">
            <option disabled selected>Выберите дисциплину</option>
            @foreach($dataDisc as $elemDataDisc)
                <option value="{{ $elemDataDisc->id }}">{{ $elemDataDisc->nameDisc }}</option>
            @endforeach
        </select>
        <label for="topic">Тема:</label>
        <select name="topic" id="topic" class="inputStyle inputFilter">
            <option selected disabled>Выберите тему</option>
            @foreach($dataTopic as $elemDataTopic)
                <option class="optionElem hidden" value="{{ $elemDataTopic->id_discipline }}" data-topic-item="{{ $elemDataTopic->id }}">{{ $elemDataTopic->name }}</option>
            @endforeach
        </select>
        <button style="background: #ffffff" class="expandList" title="Сброс фильтра" id="resetFilterSearchQuestion">
            <img src="{{ URL::asset('/img/x.png') }}" alt="Сброс" class="editingImg">
        </button>
    </div>
    <div><span style="color: #F5265D;">*</span> - данные необходимые для добавления группы ответов к вопросам.</div>
    @if($lengthArrQuestion > 0)
        <table style="width:100%; margin-top: 10px">
        <tr>
            <th>№</th>
            <th>Тема</th>
            <th>Формулировка</th>
            <th><span style="color: #F5265D;">id*</span></th>
            <th>Изменить/Удалить</th>
        </tr>
        @php $incQuestion = 1; @endphp
            @foreach($dataQuestion as $elemDataQuestion)
                <tr class="styleTableTr" data-trel="{{ $elemDataQuestion->id_topic }}">
                    <td style = "background-color: #E1F98C; font-size:12px;"><b>{{ $incQuestion++ }}</b></td>
                    @foreach($dataTopic as $elemDataTopic)
                        @if($elemDataQuestion->id_topic == $elemDataTopic->id)
                            <td style = "background-color: #E1F98C; font-size:12px; width:20%"><b>{{ $elemDataTopic->name }}</b></td>
                        @endif
                    @endforeach
                    <td style = "background-color: #E1F98C; font-size:12px; width:60%"><b>{{ $elemDataQuestion->description }}</b></td>
                    <td style = "background-color: #E1F98C; font-size:12px; width:5%"><b>{{ $elemDataQuestion->id }}</b></td>
                    <td style = "background-color: #E1F98C; width:20%">
                        <button class="expandList" id="expandList" title="Показать/Скрыть">
                            <img src="{{ URL::asset('/img/plus.png') }}" alt="Показать" class="editingImg" id="imgExpandList">
                        </button>
                        <a href="{{ route('update-questions', $elemDataQuestion->id) }}" title="Изменить">
                            <img src="{{ URL::asset('/img/edit.png') }}" alt="Изменить" class="editingImg">
                        </a>
                        <a href="{{ route('question-delete', $elemDataQuestion->id) }}" title="Удалить">
                            <img src="{{ URL::asset('/img/delete.png') }}" alt="Удалить" class="editingImg">
                        </a>
                    </td>
                </tr>
                <tr id="listInTable" class="hidden">
                    <td colspan="5">
                        @foreach($dataAnswers as $elemDataAnswers)
                            @if($elemDataAnswers->id_question == $elemDataQuestion->id)
                               <li class="answerLi" >{{ $elemDataAnswers-> description_answer}}
                                   @if($elemDataAnswers->correct == 1)
                                       |<b>Верный</b> |
                                   @endif
                                </li>
                            @endif
                        @endforeach
                                <div class="addFormAnswer hidden">
                                    <form action="{{route('form-addAnswer')}}" method="POST">
                                        @csrf
                                        <input name="answer" class="inputStyle" type="text" placeholder="Введите вариант ответа">
                                        <input type="checkbox" name="check" value="1">
                                        <input name="quest" type="hidden" value="{{ $elemDataQuestion->id }}">
                                        <input name="topic" type="hidden" value="{{ $elemDataQuestion->id_topic }}">
                                        <button type="submit" style="display: inline-block" class="greenBtn">Добавить</button>
                                    </form>
                                </div>
                            <li style="margin-top: 10px" class="errorLi">
                                <button id="addFormBtn" style="background: #ffffff" class="expandList" title="Добавить ответ">
                                    <img src="{{ URL::asset('/img/plus.png') }}" alt="Добавить" class="editingImg listEditingImg">
                                </button>
                            </li>
                    </td>
                </tr>
            @endforeach
    </table>
    @else
        <div style="padding:15px; text-align:center;">
            <p>Нет вопросов.</p>
        </div>
    @endif

    <script src="/js/questions.js"></script>
@endsection
