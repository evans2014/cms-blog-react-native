@extends('layouts.app') {{-- или admin.layout за admin панела --}}

@section('title', 'Page Not Found')

@section('content')
<div style="text-align:center; padding: 100px;">
    <h1 style="font-size: 120px; color: #f87171;">404</h1>
    <h2 style="font-size: 36px; margin: 20px 0;">Oops! Page not found</h2>
    <p style="font-size: 18px; color: #6b7280;">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
    <a href="{{ url('/') }}" style="display:inline-block; margin-top:30px; padding:10px 20px; background:#3b82f6; color:#fff; border-radius:6px; text-decoration:none;">Go Home</a>
</div>
@endsection