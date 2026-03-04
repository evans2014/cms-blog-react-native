<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;

class MenuController extends Controller
{

    public function index()
    {
        return Menu::with('page')->orderBy('order')->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'type' => $item->type,
                'slug' => $item->page?->slug, // връща slug на страницата
            ];
        });
    }
}