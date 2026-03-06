@extends('admin.layout')

@section('content')

    <div class="card p-4">
        <h1 class="page-title">{{ isset($menu) ? 'Edit Menu Item' : 'Add Menu Item' }}</h1>
        <form action="{{ isset($menu) ? route('admin.menus.update', $menu->id) : route('admin.menus.store') }}"
              method="POST">
            @csrf
            @if(isset($menu))
                @method('PUT')
            @endif

            <div class="form-group mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $menu->title ?? '') }}"
                       required>
            </div>

            <div class="form-group mb-3">
                <label>Type</label>
                <select name="type" id="menu-type" class="form-control" required>
                    <option value="page" {{ (old('type', $menu->type ?? '')=='page')?'selected':'' }}>Page</option>
                    <option value="post_overview" {{ (old('type', $menu->type ?? '')=='post_overview')?'selected':'' }}>
                        News Overview
                    </option>
                    <option value="custom" {{ (old('type', $menu->type ?? '')=='custom')?'selected':'' }}>Custom URL
                    </option>
                </select>
            </div>

            <div class="form-group mb-3" id="page-select-group" style="display: none;">
                <label>Page</label>
                <select name="page_id" class="form-control">
                    <option value="">--Select Page--</option>
                    @foreach($pages as $page)
                        <option value="{{ $page->id }}" {{ (old('page_id', $menu->page_id ?? '')==$page->id)?'selected':'' }}>{{ $page->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3" id="custom-url-group" style="display: none;">
                <label>Custom URL</label>
                <input type="text" name="url" class="form-control" value="{{ old('url', $menu->url ?? '') }}">
            </div>

            <div class="form-group mb-3">
                <label>Order</label>
                <input type="number" name="order" class="form-control" value="{{ old('order', $menu->order ?? 0) }}">
            </div>

            <button class="btn btn-primary">{{ isset($menu) ? 'Update' : 'Save' }}</button>
        </form>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        function toggleMenuFields() {
          const type = document.getElementById('menu-type').value;
          document.getElementById('page-select-group').style.display = type == 'page' ? 'block' : 'none';
          document.getElementById('custom-url-group').style.display = type == 'custom' ? 'block' : 'none';
        }

        document.getElementById('menu-type').addEventListener('change', toggleMenuFields);
        toggleMenuFields(); // initial
      });
    </script>

@endsection