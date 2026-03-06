@extends('admin.layout')

@section('content')

    <h1 class="page-title">Posts</h1>

    <div class="card mb-3 p-3">
        <div class="mb-2">
        <a href="{{ route('admin.posts.create') }}" class="btn btn-success">+ Add Post</a>
        <a href="{{ route('admin.posts.trash') }}" class="btn btn-danger">
            Trash
        </a>
        </div>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Published</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->is_published ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>

                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection