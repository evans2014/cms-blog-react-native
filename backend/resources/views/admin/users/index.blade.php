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
                <a href="{{ route('admin.users.trash') }}" class="btn btn-danger">Trash</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

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
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td width="200">
                        <a href="{{ route('admin.users.edit', $user->id) }}"
                           class="btn btn-primary btn-sm">Редактирай</a>
                        @if($user->id != 1)
                            <button type="button" class="btn btn-danger btn-sm btn-delete"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"
                                    data-id="{{ $user->id }}"
                                    data-name="{{ $user->name }}">
                                Изтрий
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Няма потребители</td>
                </tr>
            @endforelse
            </tbody>
        </table>


        <!-- Общ Modal за Delete -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Потвърждение</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Сигурни ли сте, че искате да изтриете потребителя <strong id="userName"></strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отказ</button>
                        <form id="deleteForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Изтрий</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- JS за динамичен modal -->
        <script>
          document.addEventListener('DOMContentLoaded', function () {
            const deleteForm = document.getElementById('deleteForm');
            const userName = document.getElementById('userName');

            document.querySelectorAll('.btn-delete').forEach(button => {
              button.addEventListener('click', function () {
                const id = this.dataset.id;
                const name = this.dataset.name;

                userName.textContent = name;
                deleteForm.action = `/admin/users/${id}`;
              });
            });
          });
        </script>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
@endsection