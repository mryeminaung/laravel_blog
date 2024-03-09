<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $categories = ["News", "Tech", "Football", "Basketball", "Frontend", "Backend", "Asian", "European"];

        foreach ($categories as $category) {
            Category::create([
                "name" => $category
            ]);
        }

        Article::factory()->count(10)->create();
        // Category::factory()->count(5)->create();
        Comment::factory()->count(50)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
