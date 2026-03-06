@extends('admin.layout')

@section('content')
    <div class="card mb-3 p-3">
        <h1 class="page-title">Trash - Deleted Pages</h1>
        <div class="mb-2">
            <a href="{{ route('admin.pages.index') }}" class="btn btn-primary">Back to Pages</a>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
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
        @forelse($pages as $page)
            <tr>
                <td>{{ $page->id }}</td>
                <td>{{ $page->title }}</td>
                <td>{{ $page->deleted_at }}</td>

                <td>
                    {{-- Restore --}}
                    <form action="{{ route('admin.pages.restore', $page->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-primary" type="submit">Restore</button>
                    </form>

                    {{-- Force Delete --}}
                    <form action="{{ route('admin.pages.forceDelete', $page->id) }}" method="POST"
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