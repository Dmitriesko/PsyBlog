{{--@extends('layouts.admin')--}}

{{--@section('title', $article->title)--}}

{{--@section('content')--}}
{{--    <article class="article-page">--}}
{{--        <div class="article__image-wrapper">--}}
{{--            <img src="{{ Vite::asset('resources/images/тревога.png') }}" alt="Искусственный интеллект и будущее любви"--}}
{{--                 class="article__image">--}}
{{--        </div>--}}

{{--        <div class="article__content">--}}
{{--            <div class="article__meta">--}}
{{--                <p>--}}
{{--                Категория: {{ $article->category ? $article->category->name : 'Без категории' }}--}}

{{--                --}}{{--                    <strong>Категория:</strong>--}}
{{--                    {{ $article->category ? $article->category->name : 'Без категории' }}--}}
{{--                </p>--}}
{{--                <span class="article__category">{{$article->category_id}}</span>--}}
{{--                <span class="article__views">👁 255</span>--}}
{{--                <span class="article__time">⏱ {{$article->created_at->format('d-m-Y H:i')}}</span>--}}
{{--            </div>--}}

{{--            <p class="article__text">--}}
{{--                {{$article->content}}--}}
{{--            </p>--}}
{{--        </div>--}}
{{--    </article>--}}

{{--    <a class="btn-cansel" href="{{route('admin.articles.index')}}">Назад</a>--}}


{{--@endsection--}}

@extends('layouts.admin')

@section('title', $article->title)

@section('content')
    <article class="article-page">
        <div class="article__image-wrapper">
            @if($article->image_preview)
                <img src="{{ asset('storage/' . $article->image_preview) }}" alt="Превью" style="max-width:400px;">
            @else
                <img src="{{ Vite::asset('resources/images/no-image.svg') }}" alt="Нет изображения"
                     class="article__image">
            @endif



        </div>

        <div class="article__content">
            <div class="article__meta">
                <span class="article__category">{{ $article->category ? $article->category->title : 'Без категории' }}</span>
                <span class="article__views">👁 255</span>
                <span class="article__time">⏱️ {{$article->created_at->format('d-m-Y H:i')}}</span>
            </div>

            <p class="article__text">
                {{$article->content}}
            </p>
        </div>
    </article>

    <a class="btn-cansel" href="{{route('admin.articles.index')}}">Назад</a>


@endsection

