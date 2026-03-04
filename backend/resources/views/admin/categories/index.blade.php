@extends('admin.layout')

@section('content')

    <h1 class="page-title">Categories</h1>

    <div class="card">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-success">+ Add Category</a>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Delete this category?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">No categories found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div style="margin-top:15px;">
        {{ $categories->links() }}
    </div>

@endsection