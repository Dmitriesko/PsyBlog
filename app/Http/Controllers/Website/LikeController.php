<?php


//namespace App\Http\Controllers\Website;
//
//use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
//use App\Models\Article;
//use App\Models\Like;
//
//class LikeController extends Controller
//{
//    public function toggle(Article $article)
//    {
//        if (!auth()->check()) {
//            return redirect()->back()->with('error', 'Сначала войдите в систему');
//        }
//
//        // Получаем id пользователя безопасно, без null
//        $userId = auth()->id();
//
//        $like = Like::where('user_id', $userId)
//            ->where('article_id', $article->id)
//            ->first();
//
//        if ($like) {
//            $like->delete();
//        } else {
//            Like::create([
//                'user_id' => $userId,
//                'article_id' => $article->id
//            ]);
//        }
//
//        return redirect()->back();
//    }
//}



namespace App\Http\Controllers\Website;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Like;


class LikeController extends Controller
{
    public function toggle(Article $article)
    {
        $user = auth()->user();

        if (!auth()->check()) {
            return response()->json(['message' => 'Сначала войдите в систему'], 401);
        }

        $user->id = auth()->id();
//        if (!$user) {
//            return redirect()->back()->with('error', 'Сначала войдите в систему');
//        }

        $like = Like::where('user_id', $user->id)
            ->where('article_id', $article->id)
            ->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            Like::create([
                'user_id' => $user->id,
                'article_id' => $article->id
            ]);
            $liked = true;
        }

        $count = Like::where('article_id', $article->id)->count();


        return response()->json([
            'count' => $count,
            'liked' => $liked
        ]);
    }
}
