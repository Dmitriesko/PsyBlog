<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Article $article) {
        $request->validate([
            'body' => 'required',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'article_id' => $article->id,
            'body' => $request->body
        ]);

        return redirect()->back();
    }
}
