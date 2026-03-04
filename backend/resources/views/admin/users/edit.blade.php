@extends('admin.layout')

@section('title', 'Редактирай потребител')

@section('content')
    <div class="card">
    <h1>Редактирай потребител</h1>

    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="block mb-2 font-medium">Име</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="form-group">
            <label class="block mb-2 font-medium">Имейл</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="form-group">
            <label class="block mb-2 font-medium">Нова парола (по избор)</label>
            <input type="password" name="password" class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div class="form-group">
            <label class="block mb-2 font-medium">Потвърди нова парола</label>
            <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Запази</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Отказ</a>
        </div>
    </form>
</div>
@endsection