@extends('admin.layout')

@section('content')
    <div class="card mb-3 p-3">
        <h1 class="page-title">Posts</h1>
        <div class="mb-2">
            <a href="{{ route('admin.posts.create') }}" class="btn btn-success">+ Add Post</a>
            <a href="{{ route('admin.posts.trash') }}" class="btn btn-danger">
                Trash
            </a>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Published</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->is_published ? 'Yes' : 'No' }}</td>
                <td width="200">
                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                    <button
                            class="btn btn-danger"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal"
                            data-id="{{ $post->id }}">
                        Delete
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <!-- DELETE MODAL -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Delete Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Are you sure you want to delete this post?
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
          form.action = "/admin/posts/" + id;
        });
      });
    </script>

@endsection