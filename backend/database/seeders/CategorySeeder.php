<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'News']);
        Category::create(['name' => 'Updates']);
        Category::create(['name' => 'Tips']);
    }
}