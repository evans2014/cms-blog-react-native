<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::latest()->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'nullable|string',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['is_published'] = $request->has('is_published');

        Page::create($data);

        return redirect()->route('admin.pages.index')->with('success', 'Page created.');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'nullable|string',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['is_published'] = $request->has('is_published');

        $page->update($data);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated.');
    }

/*    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted.');
    }*/
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();
        return redirect()->back()->with('success', 'Page moved to trash');
    }


    public function restore($id)
    {
        $post = Page::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->back()->with('success', 'Post restored successfully');
    }

    public function trash()
    {
        $pages = Page::onlyTrashed()->get();
        return view('admin.pages.trash', compact('pages'));
    }

    public function forceDelete($id)
    {
        $post = Page::withTrashed()->findOrFail($id);
        $post->forceDelete();

        return redirect()->back()->with('success', 'Post permanently deleted');
    }
}