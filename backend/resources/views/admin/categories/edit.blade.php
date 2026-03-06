@extends('admin.layout')

@section('content')
    <div class="card">
        <h1 class="page-title">Edit Category</h1>
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required>
            </div>
            <button class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection