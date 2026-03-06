@extends('admin.layout')

@section('content')

    <h1 class="text-2xl mb-4">Pages</h1>

    <div class="card mb-3 p-3">
        <div class="mb-2">
            <a href="{{ route('admin.pages.create') }}" class="btn btn-success">Add Page</a>
            <a href="{{ route('admin.pages.trash') }}" class="btn btn-danger">Trash</a>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Published</th>
            <th width="200">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pages as $page)
            <tr>
                <td>{{ $page->id }}</td>
                <td>{{ $page->title }}</td>
                <td>{{ $page->slug }}</td>
                <td>{{ $page->is_published ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-primary btn-sm">Edit</a>

                    <button
                            class="btn btn-danger btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal"
                            data-id="{{ $page->id }}">
                        Delete
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $pages->links() }}


    <!-- DELETE MODAL -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Delete Page</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Are you sure you want to delete this page?
                </div>

                <div class="modal-footer">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        var deleteModal = document.getElementById('deleteModal');

        deleteModal.addEventListener('show.bs.modal', function (event) {
          var button = event.relatedTarget;
          var id = button.getAttribute('data-id');

          var form = document.getElementById('deleteForm');
          form.action = "/admin/pages/" + id;
        });
      });
    </script>

@endsection