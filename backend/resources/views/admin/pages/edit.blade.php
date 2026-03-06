@extends('admin.layout')

@section('content')
    <div class="card">
        <h1 class="page-title">Edit Page</h1>
        <form action="{{ route('admin.pages.update', $page->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="block mb-1">Title</label>
                <input type="text" name="title" class="w-full border px-3 py-2" value="{{ old('title', $page->title) }}"
                       required>
            </div>

            <div class="form-group">
                <label class="block mb-1">Content</label>
                <textarea name="content" class="w-full border px-3 py-2"
                          rows="6">{{ old('content', $page->content) }}</textarea>
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox"
                           name="is_published" {{ old('is_published', $page->is_published) ? 'checked' : '' }}>
                    Published
                </label>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection