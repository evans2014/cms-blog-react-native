@extends('admin.layout')

@section('title', 'Нов потребител')

@section('content')
    <div class="card">
        <h1 class="page-title">Нов потребител</h1>
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="form-group">
                <label class="block mb-2 font-medium">Име</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div class="form-group">
                <label class="block mb-2 font-medium">Имейл</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div class="form-group">
                <label class="block mb-2 font-medium">Парола</label>
                <input type="password" name="password" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div class="form-group">
                <label class="block mb-2 font-medium">Потвърди парола</label>
                <input type="password" name="password_confirmation"
                       class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Създай</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Отказ</a>
            </div>
        </form>
    </div>
@endsection