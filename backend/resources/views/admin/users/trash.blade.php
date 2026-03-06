@extends('admin.layout')

@section('content')



<div class="card">
    <h1 class="page-title">Кошче на потребители</h1>
    <div class="mb-2">
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mb-3">← Всички потребители</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</div>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Име</th>
            <th>Email</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @forelse($trashedUsers as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td class="d-flex gap-2">
                    <!-- Restore бутон -->
                    <form action="{{ route('admin.users.restore', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Възстанови</button>
                    </form>

                    <!-- Force delete бутон -->
                    <form action="{{ route('admin.users.forceDelete', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Сигурни ли сте, че искате да изтриете окончателно този потребител?')">
                            Изтрий окончателно
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">Няма изтрити потребители</td>
            </tr>
        @endforelse
        </tbody>
    </table>

@endsection