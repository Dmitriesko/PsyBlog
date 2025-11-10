<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PsyBlog</title>
    @vite('resources/css/app.css')
    @vite('resources/css/style.css')
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<header class="header">
    <div class="header__title">
        <h1 class="title">EUNOIA</h1>
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

            <input type="checkbox" id="searchToggle" class="search-toggle">

            <label for="searchToggle" class="search-btn">
                <i class="fa-solid fa-magnifying-glass"></i>
            </label>

            <div id="searchOverlay" class="search-overlay hidden">
                <form action="{{ route('article.search') }}" method="GET" class="search-form">
                    <input type="text" name="q" placeholder="Поиск по статьям..." class="search-input">
                </form>
                <label for="searchToggle" class="close-search">✖</label>
            </div>
        </nav>
    </div>


</header>


<main class="content">
    <section class="main-article">
        <div class="container">
            <a href="{{ route('article.show', $lastArticle->id) }}" class="main-article__link">
                <div class="main-article__image-wrapper">
                    @if($lastArticle->image_preview)
                        <img class="articles__image" src="{{ Storage::url($lastArticle->image_preview) }}" alt="{{ $lastArticle->title }}">
                    @else
                        <img class="articles__image" src="{{ Vite::asset('resources/images/default.jpg') }}" alt="{{ $lastArticle->title }}">
                    @endif
                    <div class="main-article__overlay">
                        <h2 class="main-article__title">{{$lastArticle->title}}</h2>
                    </div>
                </div>
            </a>
        </div>
    </section>

    {{-- Навигация по категориям --}}


@if(!empty($categories) && $categories->count())
        <nav class="category-nav">
            <div class="category-nav__scroll">
                @foreach ($categories as $category)
                    <a href="{{ route('article.index') }}?category={{ $category->slug_text }}" class="category-nav__link">
                        {{ $category->title }}
                    </a>
                @endforeach
            </div>
        </nav>
        @endif

    <section class="articles">
        <h2 class="articles__title">Популярное в категориях</h2>
        <div class="articles__list">
            <article class="articles__item">
                <div class="articles__image-wrapper">
                    <img class="articles__image" src="{{ Vite::asset('resources/images/card1.jpg') }}" alt="">
                    <!-- <span class="articles__category">ПСИХОЛОГИЯ</span> -->
                </div>
                <h3 class="articles__name">Почему мы боимся перемен</h3>
                <p class="articles__text">Разбираемся в страхах, связанных с неизвестностью.</p>
            </article>

            <article class="articles__item">
                <div class="articles__image-wrapper">
                    <img class="articles__image" src="{{ Vite::asset('resources/images/card2.jpg') }}" alt="">
                </div>
                <h3 class="articles__name">Самооценка: враг или союзник?</h3>
                <p class="articles__text">Влияние самооценки на повседневные решения и ментальное здоровье.</p>
            </article>

            <article class="articles__item">
                <div class="articles__image-wrapper">
                    <img class="articles__image" src="{{ Vite::asset('resources/images/card3.webp') }}" alt="">
                </div>
                <h3 class="articles__name">Этика использования ИИ в психологической помощи</h3>
                <p class="articles__text"></p>
            </article>

            <article class="articles__item">
                <div class="articles__image-wrapper">
                    <img class="articles__image" src="{{ Vite::asset('resources/images/card4.png') }}">
                </div>
                <h3 class="articles__name">Плюсы токсичности</h3>
                <p class="articles__text">Какова истинная природа токсичности?</p>
            </article>
        </div>
    </section>


    <section class="container">
        <h2 class="articles__title">Все статьи</h2>
        <div class="articles__list">
            @foreach($articles as $article)
                <a href="{{ route('article.show', $article->id) }}" class="articles__item-link">
                    <article class="articles__item">
                        <div class="articles__image-wrapper">
                            @if($article->image_preview)
                                <img class="articles__image" src="{{ Storage::url($article->image_preview) }}" alt="{{ $article->title }}">
                            @else
                                <img class="articles__image" src="{{ Vite::asset('resources/images/default.jpg') }}" alt="{{ $article->title }}">
                            @endif
                        </div>
                        <h3 class="articles__name">{{ $article->title }}</h3>
{{--                        <p class="articles__text">{{ Str::limit($article->description, 120) }}</p>--}}
                    </article>
                </a>
            @endforeach
        </div>
    </section>

</main>

<footer class="footer">

</footer>

</body>

</html>
