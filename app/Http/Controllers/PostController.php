<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'comments.user'])
            ->withUserLike(auth()->id())
            ->latest()
            ->paginate(10);

        return view('livewire.feed.index', compact('posts'));
    }

    public function profile($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $posts = Post::where('user_id', $user->id)
            ->latest()
            ->get();

        return view('livewire.profile.index', compact('user', 'posts'));
    }

    public function show(Post $post)
    {
        $post->load(['user', 'comments.user']);
        $post->loadUserLike(auth()->id());

        return view('livewire.posts.show', compact('post'));
    }
}
