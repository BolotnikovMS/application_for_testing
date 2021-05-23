@extends('layouts.app')

@section('title-blog')Статистика@endsection

@section('content')
    <h1>Список групп в которых пройдены тесты</h1>

    <div style="padding:1px; margin-top: 1px">
        @php
            $countGroup = 1;
        @endphp
        @foreach($dataGroup as $elemDataGroup)
            <li class="errorLi">
                {{ $countGroup++ }}. {{ $elemDataGroup->name }}
                <a href="{{ route('listgroup', $elemDataGroup->id) }}">
                    <img src="{{ URL::asset('/img/eye.png') }}" alt="Посмотреть" title="Посмотреть"
                         class="editingImg listEditingImg" >
                </a>
            </li>
        @endforeach
    </div>
@endsection
