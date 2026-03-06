@extends('admin.layout')

@section('content')

    <h1 class="page-title">Dashboard</h1>

    <!-- Stats Cards -->
    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:20px; margin-bottom:30px;">

        <div class="card">
            <h3>Total Posts</h3>
            <p style="font-size:28px; font-weight:bold;">
                {{ \App\Models\Post::count() }}
            </p>
            <div class="mb-2">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Manage</a>
            </div>
        </div>

        <div class="card">
            <h3>Total Pages</h3>
            <p style="font-size:28px; font-weight:bold;">
                {{ \App\Models\Page::count() }}
            </p>
            <div class="mb-2">
                <a href="{{ route('admin.pages.index') }}" class="btn btn-primary">Manage</a>
            </div>
        </div>

        <div class="card">
            <h3>Menu Items</h3>
            <p style="font-size:28px; font-weight:bold;">
                {{ \App\Models\Menu::count() }}
            </p>

            <div class="mb-2">
                <a href="{{ route('admin.menus.index') }}" class="btn btn-primary">Manage</a>
            </div>
        </div>

    </div>

    <!-- Latest Posts -->
    <div class="card">
        <h2 style="margin-bottom:15px;">Latest Posts</h2>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Title</th>
                <th>Published</th>
                <th>Date</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach(\App\Models\Post::latest()->take(5)->get() as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->is_published ? 'Yes' : 'No' }}</td>
                    <td>{{ $post->created_at->format('d M Y') }}</td>
                    <td width="200">
                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-secondary">
                            Edit
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection