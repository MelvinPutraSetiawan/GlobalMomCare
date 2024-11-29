<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    /** @use HasFactory<\Database\Factories\PictureFactory> */
    use HasFactory;

    protected $fillable = ['pictureLink'];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_pictures');
    }

    public function forums()
    {
        return $this->belongsToMany(Forum::class, 'forum_pictures');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_pictures');
    }
}
