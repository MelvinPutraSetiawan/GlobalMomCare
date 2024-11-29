<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    /** @use HasFactory<\Database\Factories\ForumFactory> */
    use HasFactory;

    protected $fillable = ['title', 'content', 'freqAsk', 'account_id'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'forum_categories');
    }

    public function pictures()
    {
        return $this->belongsToMany(Picture::class, 'forum_pictures');
    }
}
