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

        return view('livewire.posts.index', compact('posts'));
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

    public function create()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        return view('livewire.posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'caption' => 'nullable|string|max:2200',
        ]);

        $imagePath = $request->file('image')->store('posts', 'public');

        auth()->user()->posts()->create([
            'image_path' => $imagePath,
            'caption' => $validated['caption'],
            'likes_count' => 0,
            'comments_count' => 0,
        ]);

        return redirect()->route('home')->with('success', 'Post created successfully!');
    }

}
