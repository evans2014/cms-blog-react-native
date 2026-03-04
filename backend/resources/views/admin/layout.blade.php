<!DOCTYPE html>
<html>
<head>
    <title>CMS Admin</title>
    <link rel="stylesheet" href="{{ asset('admin.css') }}">
</head>
<body>

<div class="admin-wrapper">

    <div class="sidebar">
        <h2>CMS Admin</h2>

        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.users.index') }}">Users</a>
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

</body>
</html>