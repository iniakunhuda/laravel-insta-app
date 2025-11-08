<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index()
    {
        $likes = auth()->user()->receivedLikes()
            ->with(['user', 'post'])
            ->latest()
            ->get();

        // Mark all as read
        auth()->user()->receivedLikes()->where('is_read', false)->update(['is_read' => true]);

        return view('livewire.likes.index', compact('likes'));
    }

    public function store(Post $post)
    {
        $user = auth()->user();

        if (!$post->isLikedBy($user->id)) {
            $post->likes()->create([
                'user_id' => $user->id,
            ]);
        }

        return back();
    }

    public function destroy(Post $post)
    {
        $post->likes()->where('user_id', auth()->id())->delete();

        return back();
    }
}
