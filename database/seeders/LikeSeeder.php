<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::role('user')->get();
        $posts = Post::all();

        foreach ($posts as $post) {
            $randomUsers = $users->random(rand(1, 3));

            foreach ($randomUsers as $user) {
                if ($user->id !== $post->user_id) {
                    Like::create([
                        'user_id' => $user->id,
                        'post_id' => $post->id,
                    ]);

                    $post->increment('likes_count');
                }
            }
        }
    }
}
