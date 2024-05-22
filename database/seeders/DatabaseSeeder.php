<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Hashtag;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call([
            RoleSeeder::class,
            PositionSeeder::class

        ]);
        $adminRole = Role::where('name', 'admin')->first();
        $managerRole = Role::where('name', 'manager')->first();
        $userRole = Role::where('name', 'user')->first();

        // Create users and assign roles
        $admin = User::factory()->create([
            'username' => 'Admin User',
            'email' => 'admin@example.com',
        ]);
        $admin->roles()->attach($adminRole);

        $manager = User::factory()->create([
            'username' => 'Manager User',
            'email' => 'manager@example.com',
        ]);
        $manager->roles()->attach($managerRole);

        $user = User::factory()->create([
            'username' => 'Regular User',
            'email' => 'user@example.com',
        ]);
        $user->roles()->attach($userRole);

        // Create posts for users
        $adminPosts = Post::factory()->count(10)->create(['user_id' => $admin->id]);
        $managerPosts = Post::factory()->count(10)->create(['user_id' => $manager->id]);
        $userPosts = Post::factory()->count(20)->create(['user_id' => $user->id]);

        // Create hashtags
        $hashtags = Hashtag::factory()->count(10)->create();

        // Attach hashtags to posts
        foreach ($adminPosts as $post) {
            $post->hashtags()->attach($hashtags->random(3));
        }

        foreach ($managerPosts as $post) {
            $post->hashtags()->attach($hashtags->random(3));
        }

        foreach ($userPosts as $post) {
            $post->hashtags()->attach($hashtags->random(3));
        }
    }
}
