@extends('layout')

@section('title_name')
    Авторизация
@endsection

@section('main')
    <div class="authorization">
        <div class="container">
            <h1>Авторизация в профиле</h1>
            <p class="homeProblem">{{ $errors->homeProblem->first() }}</p>
            <form action="{{ route('authorization') }}" method="POST">
                {{ csrf_field() }}

                <p class="error">{{ $errors->authorization->first('login') }}</p>
                <input type="text" name="login" placeholder="Ваш логин">

                <p class="error">{{ $errors->authorization->first('password') }}</p>
                <input type="password" name="password" placeholder="Ваш пароль">

                <input type="submit" value="Авторизироваться">
            </form>
        </div>
    </div>

@endsection
