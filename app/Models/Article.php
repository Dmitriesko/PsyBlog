<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property string $title
 * @property string $description
 */
class Article extends Model
{
//    public mixed $is_published;
    protected $table = 'articles';
    protected $fillable = [
        'title',
        'description',
        'content',
        'image_preview',
        'category_id',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected static function booted(): void
    {
        static::deleting(function (Article $article) {
            if ($article->image_preview) {
                Storage::disk('public')->delete($article->image_preview);
            }
        });
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class)->latest();
    }
}




