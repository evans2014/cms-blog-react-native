@extends('admin.layout')

@section('content')
<h1 class="text-2xl mb-4">Pages</h1>
<div class="card">
<a href="{{ route('admin.pages.create') }}" class="btn btn-success">Add Page</a>
</div>
<table class="table">
    <thead>
        <tr >
            <th >ID</th>
            <th >Title</th>
            <th >Slug</th>
            <th >Published</th>
            <th >Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pages as $page)
        <tr>
            <td >{{ $page->id }}</td>
            <td >{{ $page->title }}</td>
            <td >{{ $page->slug }}</td>
            <td>{{ $page->is_published ? 'Yes' : 'No' }}</td>
            <td>
                <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('admin.pages.destroy', $page->id) }}" style="display:inline;" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $pages->links() }}
@endsection