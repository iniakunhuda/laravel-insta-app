<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'caption',
        'image_path',
        'likes_count',
        'comments_count',
    ];

    protected $casts = [
        'likes_count' => 'integer',
        'comments_count' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }

    public function isLikedBy($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    public function scopeWithUserLike($query, $userId)
    {
        return $query->with(['likes' => function ($q) use ($userId) {
            $q->where('user_id', $userId);
        }]);
    }

    public function loadUserLike($userId)
    {
        $this->load(['likes' => function ($q) use ($userId) {
            $q->where('user_id', $userId);
        }]);
    }

    public function getPostImageUrlAttribute()
    {
        if (in_array($this->image_path, ['posts/sunset.jpg', 'posts/coffee.jpg', 'posts/adventure.jpg'])) {
            return asset('img/' . basename($this->image_path));
        }

        return asset('storage/' . $this->image_path);
    }
}
