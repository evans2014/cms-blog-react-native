@extends('admin.layout')

@section('title', 'Потребители')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="card">
            <h1>Потребители</h1>
            <div class="mb-2">
                <a href="{{ route('admin.users.create') }}" class="btn btn-success">
                    + Нов потребител
                </a>
            </div>
        </div>

        @if(session('success'))
            <div>{{ session('success') }}</div>
        @endif

        <div>
            <table class="table">
                <thead>
                <tr>
                    <th>Име</th>
                    <th>Имейл</th>
                    <th>Админ</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->is_admin)
                                <span>Да</span>
                            @else
                                <span>Не</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">Edit</a>
                            @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline"
                                      style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Сигурни ли сте?')">
                                        Изтрий
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
@endsection