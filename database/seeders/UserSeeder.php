<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@instaapp.com',
            'password' => Hash::make('password'),
            'bio' => 'Administrator account',
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        $user1 = User::create([
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'bio' => 'Photography enthusiast',
            'email_verified_at' => now(),
        ]);
        $user1->assignRole('user');

        $user2 = User::create([
            'name' => 'Jane Smith',
            'username' => 'janesmith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'bio' => 'Travel blogger',
            'email_verified_at' => now(),
        ]);
        $user2->assignRole('user');

        $user3 = User::create([
            'name' => 'Mike Johnson',
            'username' => 'mikejohnson',
            'email' => 'mike@example.com',
            'password' => Hash::make('password'),
            'bio' => 'Food lover',
            'email_verified_at' => now(),
        ]);
        $user3->assignRole('user');
    }
}
