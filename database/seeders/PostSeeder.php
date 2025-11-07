<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::role('user')->get();

        foreach ($users as $user) {
            Post::create([
                'user_id' => $user->id,
                'caption' => 'Beautiful sunset at the beach! #sunset #nature',
                'image_path' => 'posts/sunset.jpg',
                'likes_count' => 0,
                'comments_count' => 0,
            ]);

            Post::create([
                'user_id' => $user->id,
                'caption' => 'Morning coffee ☕',
                'image_path' => 'posts/coffee.jpg',
                'likes_count' => 0,
                'comments_count' => 0,
            ]);
        }

        Post::create([
            'user_id' => $users->first()->id,
            'caption' => 'New adventure begins! #travel',
            'image_path' => 'posts/adventure.jpg',
            'likes_count' => 0,
            'comments_count' => 0,
        ]);
    }
}
