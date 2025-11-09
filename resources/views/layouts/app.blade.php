<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PsyBlog</title>

    @vite('resources/css/app.css')
    @vite('resources/css/style.css')
    @vite('resources/css/article_page.css')
    @vite('resources/js/likes.js')
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
</head>
<body>
<header class="header">
    <div class="header__title">
        <h1 class="title"><a href="{{route("home")}}">EUNOIA</a></h1>
    </div>

    <hr>
    <h2 class="header__subtitle">PSYCHOLOGY</h2>
    <hr>
    <div>
        <nav class="header__nav">
            <ul class="nav__list">
                <li class="nav__item nav__item--active">
                    <a href="#" class="nav__link">Популярное</a>
                </li>
                <li class="nav__item">
                    <a href="#" class="nav__link">Видео</a>
                </li>
                <li class="nav__item">
                    <a href="#" class="nav__link">Автор</a>
                </li>
            </ul>

{{--            <a href="{{ route('home') }}">Главная</a>--}}

{{--            @guest--}}
{{--                <a href="{{ route('login') }}">Вход</a>--}}
{{--                <a href="{{ route('register') }}">Регистрация</a>--}}
{{--            @else--}}
{{--                <span>Привет, {{ auth()->user()->name }}</span>--}}

{{--                <form method="POST" action="{{ route('logout') }}" style="display:inline">--}}
{{--                    @csrf--}}
{{--                    <button type="submit">Выйти</button>--}}
{{--                </form>--}}
{{--            @endguest--}}
        </nav>

        @if(session('success'))
            <div style="background:#e6ffed;padding:8px;border-radius:4px;margin:10px 0;">
                {{ session('success') }}
            </div>
        @endif

    </div>


</header>

@if (session('success'))
    <div class="bg-green-100 text-green-800 border border-green-300 rounded p-3 mb-4">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="bg-red-100 text-red-800 border border-red-300 rounded p-3 mb-4">
        {{ session('error') }}
    </div>
@endif


@yield('content')

<footer class="footer">

</footer>

<div id="flashMessage" style="display:none; position: fixed; top: 20px; right: 20px; background: #f44336; color: white; padding: 10px; border-radius: 5px; z-index: 999;">
    <span id="flashMessageText"></span>
</div>

<!-- всплывающее сообщение -->
<div id="flashMessage" style="
    display:none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: rgba(0,0,0,0.8);
    color: white;
    padding: 20px 30px;
    border-radius: 8px;
    z-index: 9999;
    font-size: 16px;
    text-align: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.3);
">
    <span id="flashMessageText"></span>
</div>


</body>

</html>

