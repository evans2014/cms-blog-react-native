<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{

    public function index()
    {
        return response()->json(Page::all());
    }

    public function show($identifier)
    {
        $page = Page::where('slug', $identifier)
            ->orWhere('id', $identifier)
            ->first();

        if (!$page) {
            return response()->json(['message' => 'Page not found'], 404);
        }

        return response()->json($page);
    }
}