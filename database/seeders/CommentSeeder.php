<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::role('user')->get();
        $posts = Post::all();

        $comments = [
            'Amazing photo!',
            'Love this! 😍',
            'Great shot!',
            'Beautiful!',
            'Awesome content!',
            'This is incredible!',
            'Keep it up!',
        ];

        foreach ($posts as $post) {
            $randomUsers = $users->random(rand(1, 2));

            foreach ($randomUsers as $user) {
                Comment::create([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                    'content' => $comments[array_rand($comments)],
                ]);

                $post->increment('comments_count');
            }
        }
    }
}
