<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\PostController;

Route::get('/menus', [MenuController::class, 'index']);
Route::get('/pages/{slug}', [PageController::class, 'show']);
Route::get('/pages', function () {
    return \App\Models\Page::where('is_published', true)->get();
});
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{slug}', [PostController::class, 'show']);
