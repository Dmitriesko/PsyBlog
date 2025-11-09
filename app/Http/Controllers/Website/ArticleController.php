<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;


class ArticleController extends Controller

{
    public function index(Request $request)
    {
        // 1) Получаем главный баннер (последняя опубликованная статья)
        $mainArticle = Article::whereNotNull('published_at')
            ->latest('created_at')
            ->first();

        // 2) Базовый запрос для списка статей (опубликованные)
        $query = Article::where('is_published', true)->with('category');

        // (опционально) фильтр по категории из query string: /article?category=slug
        if ($request->filled('category')) {
            $categorySlug = $request->input('category');
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug_text', $categorySlug); // используем slug_text вместо slug
            });
        }

        // 3) Пагинация: 6 статей на страницу
        $articles = $query->latest('created_at')->paginate(6);

        // 4) Получаем все категории для панели навигации
        $categories = Category::orderBy('name')->get();

        // 5) Возвращаем view и передаём все необходимые переменные
        return view('website.article.index', compact('mainArticle', 'articles', 'categories'));
    }

    public function show(Article $article)
    {

        abort_unless($article->is_published, 404);
        return view('website.article.show', compact('article'));
    }

}

