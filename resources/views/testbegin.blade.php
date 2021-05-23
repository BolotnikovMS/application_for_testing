@extends('layouts.app')

@section('title-blog'){{$dataTest->name}}@endsection

@section('content')
    <div class="timer">
        <h3 class="countdown-title">Время выполнения теста</h3>
        <div id="countdown" class="countdown">
            <div class="countdown-number">
                <span class="hours countdown-time"></span>
                <span class="countdown-text">Часы</span>
            </div>
            <div class="countdown-number">
                <span class="minutes countdown-time"></span>
                <span class="countdown-text">Минуты</span>
            </div>
            <div class="countdown-number">
                <span class="seconds countdown-time"></span>
                <span class="countdown-text">Секунды</span>
            </div>
        </div>
    </div>
    <h1>Прохождение теста </h1>
        <input name="timer" id="timer" type="hidden" value="{{ $dataTest->testtime *= 60 }}">
    <div style="padding:5px; text-align:center;">
        <form action="{{ route('form-test-send') }}" method="POST" id="test_submit">
            @csrf

            <input name="test" type="hidden" value="{{ $dataTest->id }}">
            @php
                $questNumber = 1;    // номер вопроса
            @endphp

            <table style="width:100%; border:0;">
                @foreach($dataTestTopic as $elemDataTestTopic)
                    @if($dataTest->id == $elemDataTestTopic->id_test)
                        @foreach($dataQuestions as $elemDataQuestions)
                            @php $answerNumber = 1;    // номер ответа @endphp
                            @if($elemDataQuestions->id_topic == $elemDataTestTopic->id_topic && $elemDataQuestions->group_electrical <= Auth::user()->id_group_electrical)
                                @if($questNumber <= $dataTest->number)
                                    <tr>
                                        <td colspan="4"
                                            style="text-align:left; padding-bottom: 5px; background: #d3e6ff">
                                            <b>{{ $questNumber++ }}.</b> {{ $elemDataQuestions->description }}
                                        </td>
                                    </tr>
                                    <input name="question[]" type="hidden" value="{{ $elemDataQuestions->id }}">
                                    <input name="topic" type="hidden" value="{{ $elemDataQuestions->id_topic }}">
                                    @foreach($dataAnswers as $elemDataAnswers)
                                        @if($elemDataAnswers->id_question === $elemDataQuestions->id)
                                            <tr>
                                                <td colspan="3" style="text-align:left;   padding-bottom: 10px;">
                                                    <i>{{ $answerNumber }}
                                                        .</i> {{ $elemDataAnswers->description_answer }}
                                                </td>
                                                <td style="text-align:center;   padding-bottom: 10px;">
                                                    <input type="checkbox" name="check_{{ $elemDataQuestions->id }}[]"
                                                        id="check_{{ $elemDataQuestions->id }}[]" value="{{ $elemDataAnswers->id }}"
                                                        class="checkBoxOtv">
                                                </td>
                                            </tr>
                                            @php $answerNumber++ @endphp
                                        @endif
                                    @endforeach
                                @endif
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </table>
            <button type="submit" class="greenBtn">Отправить</button>
        </form>

    </div>
    <script src="/js/test.js"></script>
@endsection
