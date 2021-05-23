@extends('layouts.app')

@section('title-blog')Группы@endsection

@section('content')
    <h1>Добавление группы</h1>

    <form action="{{route('form-group')}}" method="POST">
        @csrf

        <label for="name">Название:</label>
        <input type="text" name="name" class="inputStyle" placeholder="Введите название группы"/>

        <div style="padding:5px; text-align:center;">
            <button type="submit" class="greenBtn">Добавить</button>
        </div>
    </form>

    <div style="padding:10px;">
        @if($countGroup > 0)
        <h4>Список добавленных групп:</h4>
        <ol class="listOl">
            @foreach($dataGroup as $elmGroup)
                <li>{{ $elmGroup->name }}
                    <a href="{{ route('group-update', $elmGroup->id) }}" title="Изменить"><img src="{{ URL::asset('/img/edit.png') }}" alt="Изменить" class="editingImg listEditingImg"></a>|
                    <a href="{{ route('group-delete', $elmGroup->id) }}" title="Удалить"><img src="{{ URL::asset('/img/delete.png') }}" alt="Удалить" class="editingImg listEditingImg"></a>
                </li>
            @endforeach
        </ol>
        @else
            <div style="padding:5px; text-align:center;">
                <p>Пока нет добавленных групп.</p>
            </div>
        @endif
    </div>
@endsection
