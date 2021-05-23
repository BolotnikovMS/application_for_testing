@extends('layouts.app')

@section('title-blog'){{ $dataUsers->surname }}@endsection

@section('content')
    <h1>Редактирование пользователя.</h1>

    <form action="{{route('users-update-submit', $dataUsers->id)}}" method="POST">
        @csrf

        <label for="group">Группа:</label>
        <select name="group" id="group" class="inputStyle">
            <option disabled>Выберите группу для изменения</option>
            @foreach($dataGroup as $elemGroup)
                @if($dataUsers->id_group == $elemGroup->id)
                    <option selected value="{{ $elemGroup->id }}">{{ $elemGroup->name }}</option>
                @else
                    <option value="{{ $elemGroup->id }}">{{ $elemGroup->name }}</option>
                @endif
            @endforeach
        </select>
        <label for="surname">Фамилия:</label>
        <input type="text" name="surname" class="inputStyle" value="{{ $dataUsers->surname }}">
        <label for="name">Имя:</label>
        <input type="text" name="name" class="inputStyle" value="{{ $dataUsers->name }}">
        <label for="lastname">Отчество:</label>
        <input type="text" name="lastname" class="inputStyle" value="{{ $dataUsers->lastname }}">
        <label for="login">Логин:</label>
        <input type="text" name="login" class="inputStyle" value="{{ $dataUsers->login }}">
        <label for="role">Роль:</label>
        <select name="role" id="role" class="inputStyle">
            <option disabled>Выберите роль для изменения</option>
            @foreach($dataRoles as $elemRole)
                @if($dataUsers->id_roles == $elemRole->id)
                    <option selected value="{{ $elemRole->id }}">{{ $elemRole->name }}</option>
                @else
                    <option value="{{ $elemRole->id }}">{{ $elemRole->name }}</option>
                @endif
            @endforeach
        </select>
        <div style="padding:5px; text-align:center;">
            <input type="submit" value="Сохранить" class="greenBtn">
        </div>
    </form>

@endsection
