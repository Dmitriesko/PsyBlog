<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.category.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $title = $request->input('title');
        Category::create([
            'title' => $title,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно создана');
    }


    public function show(string $id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));

    }


    public function edit(Category $category)
    {
//        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }


    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Категория обновлена!');
    }


    public function destroy(int $id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Категория удалена!');
    }
}
