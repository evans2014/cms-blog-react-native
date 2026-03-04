<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    public function run()
    {
        Page::create([
            'title' => 'Home',
            'slug' => 'home',
            'content' => '<p>Welcome to our website!</p>',
            'is_published' => 1
        ]);

        Page::create([
            'title' => 'About Us',
            'slug' => 'about-us',
            'content' => '<p>About our company and team.</p>',
            'is_published' => 1
        ]);

        Page::create([
            'title' => 'Contact',
            'slug' => 'contact',
            'content' => '<p>Contact us via email or phone.</p>',
            'is_published' => 1
        ]);
    }
}