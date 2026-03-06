@extends('admin.layout')

@section('content')

    <h1 class="page-title">Post Form</h1>

    <div class="card">
        <form method="POST" enctype="multipart/form-data"
              action="{{ isset($post) ? route('admin.posts.update',$post->id) : route('admin.posts.store') }}">

            @csrf
            @if(isset($post)) @method('PUT') @endif

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title"
                       value="{{ old('title', $post->title ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Categories</label>
                <div class="multi-select">
                    @foreach(\App\Models\Category::all() as $category)
                        <label class="multi-option">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                   @if(isset($post) && $post->categories->contains($category->id)) checked @endif>
                            {{ $category->name }}
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <label>Content</label>
                <textarea name="content" class="w-full border px-3 py-2" rows="6">{{ old('content', $post->content ?? '') }}</textarea>
            </div>
            <div class="form-group">
                <label>Post Image</label>
                @if(isset($post) && $post->image)
                    <img src="{{ asset('storage/'.$post->image) }}" class="mb-2" style="max-width:150px;">
                @endif
                <input type="file" name="image">
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="is_published"
                            {{ old('is_published', $post->is_published ?? false) ? 'checked' : '' }}>
                    Published
                </label>
            </div>

            <button class="btn btn-primary">Save</button>

        </form>
    </div>

    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>

    <script>
      var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
          toolbar: {
            container: [
              [{ header: [1, 2, false] }],
              ['bold', 'italic', 'underline'],
              ['link', 'image', 'video'],
              [{ list: 'ordered' }, { list: 'bullet' }]
            ],
            handlers: {
              'image': imageHandler
            }
          }
        }
      });

      function imageHandler() {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.click();

        input.onchange = async () => {
          const file = input.files[0];
          const formData = new FormData();
          formData.append('image', file);
          formData.append('_token', '{{ csrf_token() }}');

          const res = await fetch('{{ route("admin.posts.uploadImage") }}', {
            method: 'POST',
            body: formData
          });
          const data = await res.json();
          if(data.url) {
            const range = quill.getSelection();
            quill.insertEmbed(range.index, 'image', data.url);
          }
        };
      }

      document.querySelector('form').onsubmit = function() {
        document.querySelector('#content-input').value = quill.root.innerHTML;
      };
    </script>
@endsection

