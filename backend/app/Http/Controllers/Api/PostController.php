<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
   /* public function index()
    {
        return response()->json(
            Post::where('is_published', true)
                ->latest()
                ->paginate(10)
        );
    }

    public function show($slug)
    {
        $post = \App\Models\Post::where('slug', $slug)->first();

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json($post);
    }*/
    public function index()
    {
        return Post::latest()->paginate(10)->through(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'content' => $post->content,
                'image' => $post->image_url,
            ];
        });
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        return [
            'id' => $post->id,
            'title' => $post->title,
            'slug' => $post->slug,
            'content' => $post->content,
            'image' => $post->image_url,
        ];
    }
}