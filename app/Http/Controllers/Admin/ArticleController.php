<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');
        $isPublished = $request->input('is_published') !== null ? $request->input('is_published') === "on" : null;

        $categories = Category::all();


        $articles = Article::with('category')
            ->when($search !== null, function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%");
            })
            ->when($category !== null, function ($query) use ($category) {
                $query->where('category_id', $category);
            })
            ->when($isPublished !== null, function ($query) use ($isPublished) {
                $query->where('is_published', $isPublished);
            })
            ->paginate(5);



        return view('admin.article.index', compact('articles', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.article.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'is_published' => 'nullable|string|in:on',
            'image_preview' => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ]);

        $path = null;
        if ($request->hasFile('image_preview')) {
            $path = $request->file('image_preview')->store('previews', 'public');
        }

        $title = $request->input('title');
        $description = $request->input('description');
        $content = $request->input('content');
        $category = $request->input('category_id');
        /** Запишет сюда результат сравнения - true, если условие выполнилось, иначе false */
        $is_published = $request->input('is_published') === 'on';

        Article::create([
            'title' => $title,
            'description' => $description,
            'content' => $content,
            'image_preview' => $path,
            'category_id' => $category,
            'is_published' => $is_published,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Статья создана!');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {

        $article = Article::with('category')->findOrFail($id);
        return view('admin.article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::find($id);
        $categories = Category::all();
        return view('admin.article.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'is_published' => 'nullable|string|in:on',
            'image_preview' => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ]);

        $article = Article::find($id);

        $path = $article->image_preview;

        if ($request->hasFile('image_preview')) {
            $path = $request->file('image_preview')->store('previews', 'public');

            if ($article->image_preview) {
                Storage::disk('public')->delete($article->image_preview);
            }
        }

        $article->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'content' => $request->input('content'),
            'is_published' => $request->input('is_published', false),
            'category_id' => $request->input('category_id'),
            'image_preview' => $path,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Статья обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect()->route('admin.articles.index');
    }
}
