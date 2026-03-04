@extends('admin.layout')

@section('content')

<h1 class="page-title">Add Category</h1>

<div class="card">
<form action="{{ route('admin.categories.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
    </div>

    <button class="btn btn-primary">Save</button>
</form>
</div>

@endsection