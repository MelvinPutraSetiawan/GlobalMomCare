<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    public function forums()
    {
        return $this->belongsToMany(Forum::class, 'forum_categories');
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_categories');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories');
    }
}
