PROJECT NAME
React Native + Laravel CMS App

DESCRIPTION

This project is a mobile & web application built with:

- Backend: Laravel (REST API)
- Frontend: React Native (Expo) + React Native Web

The app displays:
- Pages (Home, About, etc.)
- Blog Posts
- Post Detail screen
- Carousel slider on Home page

BACKEND (Laravel API)

Base URL:
http://127.0.0.1:8000/api

Available endpoints:

GET /posts
Returns paginated posts list.

GET /posts/{slug}
Returns single post by slug.

GET /pages/{slug}
Returns page content (home, about, etc.)

Posts response structure:
{
  id,
  title,
  slug,
  content,
  image
}

FRONTEND (React Native + Expo)

Main Screens:

- HomeScreen
  - Carousel of latest posts
  - Clickable dots navigation
  - Home page content below carousel

- PostDetailScreen
  - Post image
  - Post title
  - Post content

- Dynamic pages via slug

CAROUSEL FUNCTIONALITY

Implemented using:

- FlatList (horizontal)
- pagingEnabled
- scrollToIndex
- getItemLayout (required for Web support)
- Dots navigation

Features:
- Swipe (Mobile)
- Clickable dots (Web & Mobile)
- Click post → navigate to PostDetail

INSTALLATION

1. Backend (Laravel)

composer install
php artisan migrate
php artisan serve

2. Frontend (Expo)

npm install
npx expo start

For Web:
press "w"

For Android:
press "a"

For iOS:
press "i"

PROJECT STRUCTURE

/api
  api.js

/screens
  HomeScreen.js
  HomeTabScreen.js
  NewsScreen.js
  PostDetailScreen.js
  ContactScreen.js
