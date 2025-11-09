@extends('layouts.app')

@section('content')
    <article class="article-page">
        <div class="article__image-wrapper">
            @if($article->image_preview)
                <img src="{{ Storage::url($article->image_preview) }}" alt="{{ $article->title }}" class="article__image">
            @else
                <img src="{{ Vite::asset('resources/images/тревога.png') }}" alt="{{ $article->title }}" class="article__image">
            @endif
        </div>

        <div class="article__content">
            <div class="article__meta">
                <span class="article__category">{{ $article->category->title ?? 'Без категории' }}</span>
                <span class="article__views">👁 255</span>
                <span class="article__time">⏱ 6 мин.</span>
            </div>

            <h1 class="article__title">{{ $article->title }}</h1>
            <time class="article__date">{{ $article->created_at->format('d.m.Y') }}</time>

            <p class="article__text">{!! nl2br(e($article->content)) !!}</p>
        </div>
    </article>

    <article class="main-article">
{{--        <h1>{{ $article->title }}</h1>--}}
{{--        <img src="{{ $article->image }}" alt="{{ $article->title }}">--}}

{{--        @if(auth()->check())--}}
{{--            <form action="{{ route('like.toggle', $article->id) }}" method="POST">--}}
{{--                @csrf--}}
{{--                <button type="submit">❤️</button>--}}
{{--            </form>--}}
{{--        @else--}}
{{--            <a href="{{ route('login') }}">🤍</a>--}}
{{--        @endif--}}

        <form action="{{ route('articles.like', $article->id) }}" method="POST">
            @csrf
            <button class="like-btn" data-article-id="123">
                ❤️ <span class="like-count">1</span>
            </button>

        </form>

        <h3>Комментарии ({{ $article->comments->count() }})</h3>
        <ul>
            @foreach($article->comments as $comment)
                <li>
                    <strong>{{ $comment->user->name }}:</strong> {{ $comment->body }}
                </li>
            @endforeach
        </ul>

        @auth
            <form action="{{ route('articles.comment', $article->id) }}" method="POST">
                @csrf
                <textarea name="body" rows="3" placeholder="Оставьте комментарий"></textarea>
                <button type="submit">Отправить</button>
            </form>
        @endauth
    </article>

@endsection


