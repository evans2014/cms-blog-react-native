@extends('admin.layout')

@section('content')

    <h1 class="page-title">Menus</h1>

    <div class="card mb-3">
        <div class="mb-2">
        <a href="{{ route('admin.menus.create') }}" class="btn btn-success">+ Add Menu Item</a>
        </div>
    </div>

    <div class="card">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Type</th>
                <th>Link</th>
                <th>Order</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($menus as $menu)
                <tr>
                    <td>{{ $menu->id }}</td>
                    <td>{{ $menu->title }}</td>
                    <td>{{ ucfirst(str_replace('_',' ',$menu->type)) }}</td>
                    <td>
                        @if($menu->type=='page')
                            {{ $menu->page->title ?? '—' }}
                        @elseif($menu->type=='post_overview')
                            News Overview
                        @else
                            {{ $menu->url }}
                        @endif
                    </td>
                    <td>{{ $menu->order }}</td>
                    <td>
                        <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this menu item?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No menu items found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

@endsection