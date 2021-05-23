@extends('layouts.app')

@section('content')
    <h1>Список группы "{{ $dataGroup->name }}" и результаты</h1>

    <div style="padding:5px; text-align:center;">
        @if(count($dataTestUsers) > 0)
            <table style="width:100%;">
                <tr>
                    <th rowspan="2">№</th>
                    <th rowspan="2">Ф.И.О.</th>
                    <th rowspan="2">Название теста</th>
                    <th rowspan="2" style="width: 5%">Всего вопросов</th>
                    <th colspan="3">Статистика ответов</th>
                    <th rowspan="2">Оценка</th>
                    <th rowspan="2"></th>
                </tr>
                <tr>
                    <td style="color: #6e90a6; font-size: 14px; font-weight: 600; width: 5%">С ответами</td>
                    <td style="color: #6e90a6; font-size: 14px; font-weight: 600; width: 5%">Правильных ответов</td>
                    <td style="color: #6e90a6; font-size: 14px; font-weight: 600; width: 5%">Неправильных ответов</td>
                </tr>
                @php $incList = 1; @endphp
                @foreach($dataUsers as $elemDataUser)
                    @foreach($dataTest as $elemDataTest)
                        @php $correctAnswer = 0; @endphp
                        <tr>
                            <td style="background-color: #E1F98C; font-size:12px;"><b>{{ $incList++ }}</b></td>
                            <td style="background-color: #E1F98C; font-size:12px;">
                                <b>{{ $elemDataUser->surname }} {{ $elemDataUser->name }} {{ $elemDataUser->lastname }}</b>
                            </td>
                            <td style="background-color: #E1F98C; font-size:12px;"><b>{{ $elemDataTest->name }}</b></td>
                            <td style="background-color: #E1F98C; font-size:12px;"><b>{{ $elemDataTest->number }}</b></td>
                            @php
                                $countingСorrect = 0;
                                $countingWrong = 0;
                                $countQuestion = 0;
                                $testCompleted = 0;
                            @endphp
                            @foreach($dataResult as $elemDataResult)
                                @if($elemDataResult->id_user == $elemDataUser->id && $elemDataResult->id_test == $elemDataTest->id)
                                    @php $questionCountCorrectAnswers = 0; $questionCountCorrectAnswersUser = 0; $testCompleted = 1; @endphp
                                    @foreach($dataQuestions as $elemDataQuestion)
                                        @if($elemDataQuestion->id == $elemDataResult->id_question)
                                            @foreach($dataAnswers as $elemDataAnswer)
                                                @php
                                                    $userAnswer = $elemDataResult->id_answer;
                                                    $userAnswer = str_replace('$', ' ', $elemDataResult->id_answer);
                                                    $userAnswer = explode(' ', $userAnswer);

                                                    if ($elemDataQuestion->id == $elemDataAnswer->id_question && $elemDataAnswer->correct == 1 ) {
                                                        $questionCountCorrectAnswers++;
                                                    }
                                                @endphp
                                                @for($i = 0; $i < count($userAnswer); $i++)
                                                    @if($elemDataAnswer->id == $userAnswer[$i] && $elemDataAnswer->correct == 1)
                                                        @php $countingСorrect++; $questionCountCorrectAnswersUser++; @endphp
                                                    @elseif ($elemDataAnswer->id == $userAnswer[$i] && $elemDataAnswer->correct == 0)
                                                        @php $countingWrong++; @endphp
                                                    @endif
                                                @endfor
                                            @endforeach
                                            @php $countQuestion++; @endphp
                                            @php
                                                if ($questionCountCorrectAnswers == $questionCountCorrectAnswersUser) {
                                                    $correctAnswer++;
                                                } else {
                                                    continue;
                                                }
                                            @endphp
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                            @if($testCompleted > 0)
                                <td style="background-color: #E1F98C; font-size:12px;">
                                    <b>{{ $countQuestion }}</b>
                                </td>
                                <td style="background-color: #E1F98C; font-size:12px;">
                                    <span style="color: #1FD522;">{{ $correctAnswer }}</span>
                                </td>
                                <td style="background-color: #E1F98C; font-size:12px;">
                                    <span style="color: #F5265D;">{{ $elemDataTest->number - $correctAnswer }}</span>
                                </td>
                                <td style="background-color: #E1F98C; font-size:12px;">
                                    <b>{{ ratingCalculation($elemDataTest->number, $correctAnswer) }}</b>
                                </td>
                                <td style="background-color: #E1F98C;">
                                    <a href="{{ route('test-result', [$elemDataTest->id, $elemDataUser->id]) }}" title="Результаты">
                                        <img src="{{ URL::asset('/img/eye.png') }}" alt="Просмотр" class="editingImg">
                                    </a>
                                    <form action="{{ route('form-save-rating', $elemDataUser->id_group) }}" method="POST" style="display: inline-block">
                                        @csrf

                                        <input type="text" name="user" class="hidden" value="{{ $elemDataUser->id }}"/>
                                        <input type="text" name="test" class="hidden" value="{{ $elemDataTest->id }}"/>
                                        <input type="text" name="rating" class="hidden" value="{{ ratingCalculation($elemDataTest->number, $correctAnswer) }}"/>
                                        <button type="submit" style="border: none; background: none">
                                            <img src="{{ URL::asset('/img/save.png') }}" alt="Записать оценку" title="Записать оценку" class="editingImg">
                                        </button>
                                    </form>
                                    <a href="{{ route('test-reset', [$elemDataTest->id, $elemDataUser->id, $elemDataUser->id_group]) }}" title="Удалить статистику">
                                        <img src="{{ URL::asset('/img/reset.png') }}" alt="Сброс" class="editingImg">
                                    </a>
                                </td>
                            @else
                                <td colspan="5" style="background-color: #E1F98C; font-size:12px;">
                                    <b>Пока статистики нет.</b>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endforeach
            </table>
        @else
            <p>У группы пока нет тестов.</p>
        @endif
    </div>
@endsection
