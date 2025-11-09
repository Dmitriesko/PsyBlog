<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = ['title', 'slug_text'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug_text)) {
                $category->slug_text = Str::slug($category->title);
            }
        });
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
