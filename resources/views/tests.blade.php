@extends('layouts.app')

@section('title-blog')Тесты@endsection

@section('content')
    <h1>Все тесты</h1>
    <div style="padding:5px; text-align:center;">
        @if($countTest > 0)
            <table style="width:100%">
                <tr>
                    <th>№</th>
                    <th>Название теста</th>
                    <th>Дисциплина</th>
                    <th>Тема</th>
                    <th>Автор</th>
                    <th>Кол-во вопросов</th>
                    <th>Статус теста</th>
                    <th>Изменить/Удалить</th>
                </tr>
                @php $incTests = 1; @endphp
                @foreach($dataTests as $elemTest)
                    <tr>
                        <td style="background-color: #E1F98C; font-size:12px;"><b>{{ $incTests++ }}</b></td>
                        <td style="background-color: #E1F98C; font-size:12px;"><b>{{ $elemTest->name }}</b></td>
                        @foreach($dataDisc as $elemDisc)
                            @if($elemDisc->id == $elemTest->id_disc)
                                <td style="background-color: #E1F98C; font-size:12px;"><b>{{ $elemDisc->nameDisc }}</b></td>
                            @endif
                        @endforeach
                        @foreach($dataTopicsTests as $elemTopicTest)
                            @if($elemTest->id == $elemTopicTest->id_test)
                                @foreach($dataTopic as $elemTopic)
                                    @if($elemTopicTest->id_topic == $elemTopic->id)
                                        <td style="background-color: #E1F98C; font-size:12px;"><b>{{ $elemTopic->name }}</b>
                                        </td>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                        <td style="background-color: #E1F98C; font-size:12px;"><b>{{ $elemTest->author }}</b></td>
                        <td style="background-color: #E1F98C; font-size:12px;"><b>{{ $elemTest->number }}</b></td>
                        <td style="background-color: #E1F98C; font-size:12px;"><b>
                            @if($elemTest->status == 1)
                                Открыт
                            @else
                                Закрыт
                            @endif
                        </b></td>
                        <td style="background-color: #E1F98C; font-size:12px;">
                            <a href="{{ route('test-update', $elemTest->id) }}"><img src="{{ URL::asset('/img/edit.png') }}"
                                                                                     alt="Изменить" class="editingImg"></a>
                            <a href="{{ route('test-delete', $elemTest->id) }}"><img
                                    src="{{ URL::asset('/img/delete.png') }}" alt="Удалить" class="editingImg"></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>Пока нет добавленных тестов.</p>
        @endif
    </div>
@endsection
