<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    protected static function booted()
    {
        static::created(function ($comment) {
            $comment->post->increment('comments_count');
        });

        static::deleted(function ($comment) {
            $comment->post->decrement('comments_count');
        });
    }
}
