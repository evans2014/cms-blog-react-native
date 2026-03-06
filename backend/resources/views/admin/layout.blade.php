<!DOCTYPE html>
<html>
<head>
    <title>CMS Admin</title>
    <link rel="stylesheet" href="{{ asset('admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="admin-wrapper">

    <div class="sidebar">
        <h2>CMS Admin</h2>

        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.users.index') }}">Users</a>
        <a href="{{ route('profile.edit') }}">Profile</a>

        <a href="{{ route('admin.posts.index') }}">Posts</a>
        <a href="{{ route('admin.categories.index') }}">Categories</a>
        <a href="{{ route('admin.pages.index') }}">Pages</a>
        <a href="{{ route('admin.menus.index') }}">Menus</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <a href="{{ route('logout')}}"
               onclick="event.preventDefault();
                                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </a>
        </form>
    </div>

    <div class="content">
        @yield('content')
    </div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
</body>
</html>