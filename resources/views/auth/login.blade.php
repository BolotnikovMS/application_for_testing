@extends('layouts.app')

@section('content')
    <div class="form-parent">
        <div class="form-auth">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <label for="login">Логин:</label>
                <input id="login" type="text" class="int-auth" name="login" value="{{ old('login') }}" required autocomplete="login" autofocus placeholder="Введите свой логин">
                <label for="password">Пароль:</label>
                <input id="password" type="password" class="int-auth"
                       name="password" required autocomplete="current-password" placeholder="Введите пароль">
                <button type="submit" class="greenBtn">Войти</button>
                <p class="par-form">
                    У вас нет аккаунта? - обратитесь к администратору системы!
                </p>
            </form>
        </div>
    </div>
@endsection
