<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;

class PostSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();

        Post::create([
            'title' => 'First Post',
            'slug' => 'first-post',
            'content' => '<p>This is the first post content.</p>',
            'is_published' => 1
        ])->categories()->attach($categories->random(1));

        Post::create([
            'title' => 'Second Post',
            'slug' => 'second-post',
            'content' => '<p>Updates on our project.</p>',
            'is_published' => 1
        ])->categories()->attach($categories->random(2));

        Post::create([
            'title' => 'Third Post',
            'slug' => 'third-post',
            'content' => '<p>Tips and tricks for productivity.</p>',
            'is_published' => 1
        ])->categories()->attach($categories->random(1));

        Post::create([
            'title' => 'Fourth Post',
            'slug' => 'fourth-post',
            'content' => '<p>News about our community.</p>',
            'is_published' => 1
        ])->categories()->attach($categories->random(2));
    }
}