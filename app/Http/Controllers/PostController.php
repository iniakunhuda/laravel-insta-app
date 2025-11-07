<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'likes', 'comments.user'])
            ->withCount(['likes', 'comments'])
            ->latest()
            ->paginate(10);

        return view('feed.index', compact('posts'));
    }
}
