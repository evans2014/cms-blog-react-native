@extends('admin.layout')

@section('content')
<h1 class="text-2xl mb-4">Add Page</h1>
<div class="card">
    <form action="{{ route('admin.pages.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        <div class="form-group">
            <label class="block mb-1">Title</label>
            <input type="text" name="title" class="w-full border px-3 py-2" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label class="block mb-1">Content</label>
            <textarea name="content" class="w-full border px-3 py-2" rows="6">{{ old('content') }}</textarea>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_published" {{ old('is_published') ? 'checked' : '' }}> Published
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection