@extends('layouts.app')

@section('content')
    <section class="container">
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

    {{ $articles->links() }}
@endsection






