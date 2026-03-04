<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Page;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $home = Page::where('slug', 'home')->first();
        $about = Page::where('slug', 'about-us')->first();

        // Home page
        Menu::create([
            'title' => 'Home',
            'type' => 'page',
            'page_id' => $home?->id,
            'url' => null,
            'order' => 0,
        ]);

        // About Us page
        Menu::create([
            'title' => 'About Us',
            'type' => 'page',
            'page_id' => $about?->id,
            'url' => null,
            'order' => 1,
        ]);

        // News overview (ще показва всички постове)
        Menu::create([
            'title' => 'News',
            'type' => 'post_overview',
            'post_overview_id' => null,
            'url' => null,
            'order' => 2,
        ]);

        // Custom link пример
        Menu::create([
            'title' => 'External Link',
            'type' => 'custom',
            'url' => 'https://example.com',
            'order' => 3,
        ]);
    }
}