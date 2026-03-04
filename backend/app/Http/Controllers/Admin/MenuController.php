<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Page;

class MenuController extends Controller
{
    // List all menus
    public function index()
    {
        $menus = Menu::orderBy('order')->get();
        return view('admin.menus.index', compact('menus'));
    }

    // Show create form
    public function create()
    {
        $pages = Page::all();
        return view('admin.menus.create', compact('pages'));
    }

    // Store new menu
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:page,post_overview,custom',
            'url' => 'nullable|string',
            'page_id' => 'nullable|exists:pages,id',
            'order' => 'nullable|integer'
        ]);

        // Автоматично задаване на url
        $data['url'] = $this->generateUrl($data);

        Menu::create($data);

        return redirect()->route('admin.menus.index')
            ->with('success','Menu created successfully');
    }

    // Show edit form
    public function edit(Menu $menu)
    {
        $pages = Page::all();
        return view('admin.menus.edit', compact('menu','pages'));
    }

    // Update menu
    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:page,post_overview,custom',
            'url' => 'nullable|string',
            'page_id' => 'nullable|exists:pages,id',
            'order' => 'nullable|integer'
        ]);

        // Автоматично задаване на url
        $data['url'] = $this->generateUrl($data);

        $menu->update($data);

        return redirect()->route('admin.menus.index')
            ->with('success','Menu updated successfully');
    }

    // Delete menu
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menus.index')
            ->with('success','Menu deleted successfully');
    }

    // Private function: generate url based on type
    private function generateUrl(array $data)
    {
        if($data['type']=='page' && !empty($data['page_id'])) {
            $page = Page::find($data['page_id']);
            return $page ? route('page.show', $page->slug) : '#';
        } elseif($data['type']=='post_overview') {
            return route('posts.index');
        } elseif($data['type']=='custom') {
            return $data['url'] ?? '#';
        }

        return '#';
    }
}