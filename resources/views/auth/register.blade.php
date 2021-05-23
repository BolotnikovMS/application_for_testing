@extends('layouts.app')

@section('title-blog')Добавить пользователя@endsection

@section('content')
    <h1>Добавление пользователя</h1>

    <div style="margin:10px 8px auto;">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <label for="surname">Фамилия:</label>
            <input name="surname" type="text" class="inputStyle" placeholder="Введите фамилию пользователя">
            <label for="name">Имя:</label>
            <input name="name" type="text" class="inputStyle" placeholder="Введите имя пользователя">
            <label for="lastname">Отчество:</label>
            <input name="lastname" type="text" class="inputStyle" placeholder="Введите отчество пользователя">
            <label for="gender">Пол:</label>
            <select name="gender" class="inputStyle">
                <option value="муж.">муж.</option>
                <option value="жен.">жен.</option>
            </select>
            <label for="password">Пароль:</label>
            <input id="password" type="password" class="inputStyle" name="password" required autocomplete="new-password" placeholder="Введите пароль">

            <label for="password-confirm">Повторите пароль:</label>
            <input id="password-confirm" type="password" class="inputStyle" name="password_confirmation" required autocomplete="new-password" placeholder="Повторите пароль">

            <label for="role">Выберите группу по электробезопастности:</label>
            <select name="group_electrical" class="inputStyle">
                <option disabled selected>Выберите группу по электробезопастности</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <label for="role">Роль пользователя:</label>
            <select name="role" class="inputStyle">
                <option disabled selected>Выберите роль пользователя</option>
                <option value="1">Администратор</option>
                <option value="2">Модератор</option>
                <option value="3">Пользователь</option>
            </select>
            <div style="padding:5px; text-align:center;">
                <button type="submit" class="greenBtn">Добавить</button>
            </div>
        </form>
    </div>
@endsection
