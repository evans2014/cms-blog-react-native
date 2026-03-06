<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // List posts
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    // Show create form
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    // Store new post
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        // Generate unique slug
        $data['slug'] = $this->generateUniqueSlug($data['title']);
        $data['is_published'] = $request->has('is_published');

        // Upload image if exists
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post = Post::create($data);

        // Sync categories
        $post->categories()->sync($request->input('categories', []));

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post created successfully.');
    }

    // Show edit form
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post','categories'));
    }

    // Update post
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        // Update slug only if title changed
        if ($post->title != $data['title']) {
            $data['slug'] = $this->generateUniqueSlug($data['title']);
        }

        $data['is_published'] = $request->has('is_published');

        // Update image
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        // Sync categories
        $post->categories()->sync($request->input('categories', []));

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post updated successfully.');
    }

    // Delete post
    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post deleted successfully.');
    }

    // Quill.js / editor image upload
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048'
        ]);

        $path = $request->file('image')->store('posts', 'public');

        return response()->json(['url' => asset('storage/'.$path)]);
    }

    // Private: generate unique slug
    private function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while(Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->back()->with('success', 'Post restored successfully');
    }

    public function trash()
    {
        $posts = Post::onlyTrashed()->get();
        return view('admin.posts.trash', compact('posts'));
    }

    public function forceDelete($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->forceDelete();

        return redirect()->back()->with('success', 'Post permanently deleted');
    }
}