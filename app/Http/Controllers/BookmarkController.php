<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index()
    {
        $posts = auth()->user()
            ->bookmarkedPosts()
            ->with(['user', 'comments.user'])
            ->withUserLike(auth()->id())
            ->withUserBookmark(auth()->id())
            ->latest('bookmarks.created_at')
            ->paginate(10);

        return view('livewire.bookmarks.index', compact('posts'));
    }

    public function store(Post $post)
    {
        if (!auth()->user()->hasBookmarkedPost($post->id)) {
            Bookmark::create([
                'user_id' => auth()->id(),
                'post_id' => $post->id,
            ]);

            return back()->with('success', 'Post bookmarked!');
        }

        return back();
    }

    public function destroy(Post $post)
    {
        Bookmark::where('user_id', auth()->id())
            ->where('post_id', $post->id)
            ->delete();

        return back()->with('success', 'Bookmark removed!');
    }
}
