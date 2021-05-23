@extends('layouts.app')

@section('title-blog')Статистика@endsection

@section('content')
    <h1>Результаты теста "{{ $dataTest->name }}"</h1>
    <div style="padding:5px; text-align:center;">
        @php
            $questNumber = 1;

            if (!is_null($dataResultIdUser)) {
                $idUser = $dataResultIdUser->id;
            } else {
                $idUser = Auth::user()->id;
            }
        @endphp

        @if(!is_null($dataResultIdUser))
            @php $incTry = 1; @endphp
            <table style="border:0;">
                <tr>
                    <th>Ф.И.О.</th>
                    <th>Попытка:</th>
                    @foreach($dataRating as $elemDataRating)
                        <th >{{ $incTry++ }}</th>
                    @endforeach
                </tr>
                <tr>
                    <td rowspan="2" style="text-align:center; padding-bottom: 5px; background: #d3e6ff">
                        {{ $dataResultIdUser->surname }} {{ $dataResultIdUser->name }}<br>{{ $dataResultIdUser->lastname }}
                    </td>

                    @if(count($dataRating) > 0)
                        <td style="text-align: center; padding: 6px; color: #6e90a6; font-size: 14px; font-weight: 600">Оценка:</td>
                        @foreach($dataRating as $elemDataRating)
                            <td>{{ $elemDataRating->rating }}</td>
                        @endforeach
                        </tr>
                        <tr>
                            <td style="text-align: center; padding: 6px; color: #6e90a6; font-size: 14px; font-weight: 600">Дата:</td>
                            @foreach($dataRating as $elemDataRating)
                                <td>{{ $elemDataRating->created_at }}</td>
                            @endforeach
                        </tr>
                    @else
                        <td rowspan="2"> Пока нет записанных попыток.</td>
                        </tr>
                    @endif
            </table>
        @endif

        <table style = "width:100%; border:0;">
            @foreach($dataResult as $elemDataResult)
                @if($idUser ==  $elemDataResult->id_user && $elemDataResult->id_test == $dataTest->id)
                    @foreach($dataQuestions as $elemDataQuestion)
                        @if($elemDataResult->id_question == $elemDataQuestion->id)
                            <tr>
                                <td colspan = "4" style="text-align:left; padding-bottom: 5px; background: #d3e6ff">
                                    <b>№{{ $questNumber++ }}.</b> {{ $elemDataQuestion->description }}
                                </td>
                            </tr>
                            @php $answerNumber = 1; @endphp
                            <tr>
                                <td>
                                    @foreach($dataAnswers as $elemDataAnswer)
                                        @if($elemDataQuestion->id == $elemDataAnswer->id_question)
                                            @if(!is_null($dataResultIdUser))
                                                @if($elemDataAnswer->correct == 1)
                                                    <li class="errorLi" style="text-align: left; padding: 0.1%"><i>{{ $answerNumber++ }}. <ins>{{ $elemDataAnswer->description_answer }}</ins></i></li>
                                                @else
                                                    <li class="errorLi" style="text-align: left; padding: 0.1%"><i>{{ $answerNumber++ }}.</i> {{ $elemDataAnswer->description_answer }}</li>
                                                @endif
                                            @else
                                                <li class="errorLi" style="text-align: left; padding: 0.1%"><i>{{ $answerNumber++ }}.</i> {{ $elemDataAnswer->description_answer }}</li>
                                            @endif
                                        @endif
                                    @endforeach

                                    <div style="padding:5px; margin-top: 15px">
                                        <p style="text-align:left;"><b>Выбранный(е) ответ(ы):</b></p>
                                        @foreach($dataAnswers as $elemDataAnswer)
                                            @php
                                                $userAnswer = $elemDataResult->id_answer;
                                                $userAnswer = str_replace('$', ' ', $elemDataResult->id_answer);
                                                $userAnswer = explode(' ', $userAnswer);
                                            @endphp
                                                @for($i = 0; $i < count($userAnswer); $i++)
                                                    @if(!is_null($dataResultIdUser))
                                                        @if($elemDataAnswer->id == $userAnswer[$i] && $elemDataAnswer->correct == 1)
                                                            <li class="errorLi" style="text-align: left; padding: 0.1%"><span style="color: #1FD522;">- {{ $elemDataAnswer->description_answer }}</span></li>
                                                        @elseif($elemDataAnswer->id == $userAnswer[$i] && $elemDataAnswer->correct !== 1)
                                                            <li class="errorLi" style="text-align: left; padding: 0.1%"><span style="color: #F5265D;">- {{ $elemDataAnswer->description_answer }}</span></li>
                                                            @continue
                                                        @endif
                                                    @endif

                                                @endfor
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </table>
    </div>
@endsection
