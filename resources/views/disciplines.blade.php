@extends('layouts.app')

@section('title-blog')Дисциплины@endsection

@section('content')
    <h1>Дисциплины</h1>

    <h4>Список дисциплин и тем относящихся к ним:</h4>
    <div style="padding:5px;">
        @if($countDisc > 0)
            <ol class="listOl">
                @foreach($dataDisc as $elemDataDisc)
                    <li>{{ $elemDataDisc->nameDisc }}</li>
                    <ul class="listUl">
                        @if($countTopic > 0)
                            @foreach($dataTopic as $elemTopic)
                                @if($elemDataDisc->id == $elemTopic->id_discipline)
                                    <li class="answerLi">Тема. {{ $elemTopic->name }}
                                        <a href="{{ route('topic-update', $elemTopic->id) }}">
                                            <img src="{{ URL::asset('/img/edit.png') }}" alt="Изменить" class="editingImg listEditingImg">
                                        </a>|
                                        <a href="{{ route('topic-delete', $elemTopic->id) }}">
                                            <img src="{{ URL::asset('/img/delete.png') }}" alt="Удалить" class="editingImg listEditingImg">
                                        </a>
                                    </li>
                                    <p>{{ $elemTopic->description }}</p>
                                @endif
                            @endforeach
                        @else
                            <p>Пока нет тем.</p>
                        @endif
                    </ul>
                @endforeach
            </ol>
        @else
            <p>Пока нет дисциплин.</p>
        @endif
    </div>
@endsection
