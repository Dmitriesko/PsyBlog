<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Админ-панель')</title>
    <script src="https://kit.fontawesome.com/bf0b1b5714.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('resources/css/article_page.css')
    @vite('resources/css/admin.css')
    @vite('resources/sass/app.scss')
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            width: 220px;
            background: #222;
            color: #fff;
            padding: 20px;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            margin: 10px 0;
        }
        .content {
            flex: 1;
            padding: 20px;
            background: #f8f9fa;
        }
        header {
            font-size: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="content">

    <div class="container">
        <header>@yield('title')</header>
        @yield('content')
    </div>
</div>
</body>
</html>

