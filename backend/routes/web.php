<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PageController as PageAdmin ;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::fallback(function() {
    return response()->view('errors.404', [], 404);
});

Route::get('/pages/{slug}', [PageController::class, 'show'])->name('page.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::post('posts/upload-image', [\App\Http\Controllers\Admin\PostController::class,'uploadImage'])
        ->name('posts.uploadImage');
});
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/posts/trash', [PostController::class, 'trash'])->name('posts.trash');
    Route::post('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::delete('/posts/{id}/force-delete', [PostController::class, 'forceDelete'])->name('posts.forceDelete');


    Route::get('/pages/trash', [PageAdmin::class, 'trash'])->name('pages.trash');
    //Route::delete('/pages/{id}', [PageAdmin::class, 'destroy'])->name('pages.destroy');
    Route::delete('/pages/{id}', [PageAdmin::class, 'destroy'])
        ->name('admin.pages.destroy');
    Route::post('/pages/{id}/restore', [PageAdmin::class, 'restore'])->name('pages.restore');
    Route::delete('/pages/{id}/force-delete', [PageAdmin::class, 'forceDelete'])->name('pages.forceDelete');

    Route::resource('users', UserController::class);
    Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
    Route::resource('menus', \App\Http\Controllers\Admin\MenuController::class);

});


require __DIR__.'/auth.php';
