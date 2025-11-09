@extends('layouts.app')

@section('content')

    <h1>Все статьи</h1>

    <div class="grid grid-cols-3 gap-4">
        @foreach($articles as $article)
            <div class="border rounded p-4 shadow">
                <h2 class="text-xl font-bold mb-2">{{ $article->title }}</h2>
                <p>{{ Str::limit($article->description, 120) }}</p>
                <div class="">
                    <a href="{{ route('article.show', $article->id) }}" class="article-link">
                        Читать дальше
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    {{ $articles->links() }}
@endsection






