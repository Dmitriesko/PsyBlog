@extends('layouts.admin-clear')

@section('content')
    <h1>Регистрация</h1>

    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $err)
                    <li style="color:red">{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.perform') }}" method="POST">
        @csrf
        <div>
            <label>Имя</label><br>
            <input type="text" name="name" value="{{ old('name') }}">
        </div>
        <div>
            <label>Email</label><br>
            <input type="email" name="email" value="{{ old('email') }}">
        </div>
        <div>
            <label>Пароль</label><br>
            <input type="password" name="password">
        </div>
        <div>
            <label>Подтвердите пароль</label><br>
            <input class="mb-3" type="password" name="password_confirmation">
        </div>
        <button class="btn btn-success" type="submit">Зарегистрироваться</button>

        <a class="btn btn-primary" href="{{route('login')}}">Вход</a>

    </form>
@endsection

