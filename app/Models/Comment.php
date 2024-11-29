<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    protected $fillable = ['content', 'account_id', 'forum_id'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }
}
