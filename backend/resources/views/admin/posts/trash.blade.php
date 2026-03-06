@extends('admin.layout')

@section('content')
    <div class="card mb-3 p-3">
        <h1>Trash - Deleted Posts</h1>
        <div class="mb-2">
            <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Back to Posts</a>
        </div>
    </div>
    <br>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Deleted At</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>
        @forelse($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->deleted_at }}</td>

                <td>
                    {{-- Restore --}}
                    <form action="{{ route('admin.posts.restore', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-primary" type="submit">Restore</button>
                    </form>

                    {{-- Force Delete --}}
                    <form action="{{ route('admin.posts.forceDelete', $post->id) }}" method="POST"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete Permanently</button>
                    </form>
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="4">Trash is empty</td>
            </tr>
        @endforelse
        </tbody>

    </table>

@endsection