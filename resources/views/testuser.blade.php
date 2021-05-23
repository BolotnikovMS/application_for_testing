@extends('layouts.app')

@section('title-blog')Доступные тесты@endsection

@section('content')
    <h1>Все доступные тесты и результаты.</h1>
    <div style="padding:5px; text-align:center;">
        <table style="width:100%;">
            <tr>
                <th>№</th>
                <th>Название теста</th>
                <th>Тема</th>
                <th>Кол-во вопросов</th>
                <th>Оценка</th>
                <th>Автор</th>
                <th></th>
            </tr>

            @php $incTest = 1;  @endphp
            @foreach($dataTestUser as $elemDataTestUser)
                @if($elemDataTestUser->id_group == Auth::user()->id_group)
                    @php $correctAnswer = 0; @endphp
                    @foreach($dataTests as $elemDataTests)
                        @if($elemDataTests->id == $elemDataTestUser->id_test && $elemDataTests->status == 1)
                            <tr>
                                <td style="background-color: #E1F98C; font-size:12px;"><b>{{ $incTest++ }}</b></td>
                                <td style="background-color: #E1F98C; font-size:12px;"><b>{{ $elemDataTests->name }}</b>
                                </td>
                                @foreach($dataTopicsTests as $elemTopicTest)
                                    @if($elemDataTests->id == $elemTopicTest->id_test)
                                        @foreach($dataTopic as $elemTopic)
                                            @if($elemTopicTest->id_topic == $elemTopic->id)
                                                <td style="background-color: #E1F98C; font-size:12px;">
                                                    <b>{{ $elemTopic->name }}</b>
                                                </td>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                                <td style="background-color: #E1F98C; font-size:12px; width:20%">
                                    @php
                                        $countingCorrect = 0;
                                        $countingWrong = 0;
                                        $countQuestion = 0;
                                        $testCompleted = 0;
                                    @endphp

                                    @foreach($dataResult as $elemDataResult)
                                        @if(Auth::user()->id ==  $elemDataResult->id_user && $elemDataResult->id_test == $elemDataTests->id)
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
                                                                @php $countingCorrect++; $questionCountCorrectAnswersUser++; @endphp
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
                                    <b> Всего вопросов: {{ $elemDataTests->number }}</b> <br>
                                </td>
                                <td style="background-color: #E1F98C; font-size:12px;">
                                    @if($testCompleted > 0)
                                        <b>{{ ratingCalculation($elemDataTests->number, $correctAnswer) }}</b>
                                    @else
                                        <b>Пока оценки нет</b>
                                    @endif
                                </td>
                                <td style="background-color: #E1F98C; font-size:12px;">
                                    <b>{{ $elemDataTests->author }}</b>
                                </td>

                                @php
                                    $count = 0;
                                        foreach($dataResult as $elemDataResult) {
                                            if($elemDataTestUser->id_test == $elemDataResult->id_test && $elemDataResult->id_user == Auth::user()->id) {
                                                $count += 1;
                                            }
                                        }
                                @endphp

                                @if($count > 0)
                                    <td style="background-color: #E1F98C; font-size:12px;">
                                        <b> Верных вопросов:
                                            <span style="color: #1FD522;">{{ $correctAnswer }}
                                        </span>
                                        </b> <br>
                                        <b> Неверных вопросов:
                                            <span style="color: #F5265D">{{ $elemDataTests->number - $correctAnswer }}
                                        </span>
                                        </b>
                                    </td>
                                @else
                                    <td style="background-color: #E1F98C; font-size:12px;">
                                        <a href="{{ route('test-begin', $elemDataTests->id) }}" class="greenBtn"
                                           title="Пройти тест">Пройти тест</a>
                                    </td>
                                @endif
                            </tr>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </table>
    </div>
@endsection
