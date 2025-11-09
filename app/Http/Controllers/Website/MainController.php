<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Article;


class MainController extends Controller
{
    public function index()
    {
        $lastArticle = Article::query()->latest()->first();

        $articles = Article::where('is_published', true)
        ->with ('category')
        ->latest('created_at')
//        ->take(6)
        ->paginate(6);

        $categories = Category::orderBy('name')->get();
        return view('website.main.index', compact('articles', 'lastArticle', 'categories'));

    }
}
