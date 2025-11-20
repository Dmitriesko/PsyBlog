@extends('layouts.admin-clear')

@section('content')
    <h1>Вход</h1>

    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $err)
                    <li style="color:red">{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login.perform') }}" method="POST">
        @csrf
        <div>
            <label>Email</label><br>
            <input type="email" name="email" value="{{ old('email') }}">
        </div>
        <div>
            <label>Пароль</label><br>
            <input type="password" name="password">
        </div>
        <div>
            <label><input type="checkbox" name="remember"> Запомнить меня</label>
        </div>

        <button class="btn btn-success" type="submit">Войти</button>

        <a class="btn btn-primary" href="{{route('register')}}">Регистрация</a>
    </form>
@endsection
