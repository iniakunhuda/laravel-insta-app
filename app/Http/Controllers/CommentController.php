<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:2200',
        ]);

        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'comment' => [
                    'id' => $comment->id,
                    'user_name' => $comment->user->name,
                    'user_initials' => $comment->user->initials(),
                    'user_username' => $comment->user->username,
                    'content' => $comment->content,
                    'created_at' => $comment->created_at->diffForHumans(),
                    'can_delete' => auth()->user()->can('delete', $comment)
                ],
                'comments_count' => $post->fresh()->comments_count
            ]);
        }

        return back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true
            ]);
        }

        return back();
    }
}
