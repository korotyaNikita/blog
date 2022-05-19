<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers\Main'], function () {
    Route::get('/', IndexController::class)->name('main.index');
});

Route::group(['namespace' => 'App\Http\Controllers\Personal', 'prefix' => 'personal', 'middleware' => ['auth', 'verified']], function () {
    Route::group(['namespace' => 'Main'], function () {
        Route::get('/', IndexController::class)->name('personal.main.index');
    });
    Route::group(['namespace' => 'Liked', 'prefix' => 'liked'], function () {
        Route::get('/', IndexController::class)->name('personal.liked.index');
        Route::delete('/{post}', DestroyController::class)->name('personal.liked.destroy');
    });
    Route::group(['namespace' => 'Comment', 'prefix' => 'comments'], function () {
        Route::get('/', IndexController::class)->name('personal.comments.index');
        Route::get('/{comment}/edit', EditController::class)->name('personal.comments.edit');
        Route::patch('/{comment}', UpdateController::class)->name('personal.comments.update');
        Route::delete('/{comment}', DestroyController::class)->name('personal.comments.destroy');
    });
});

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'admin', 'verified']], function () {
    Route::group(['namespace' => 'Main'], function () {
        Route::get('/', IndexController::class)->name('admin.main.index');
    });

    Route::group(['namespace' => 'Post', 'prefix' => 'posts'], function () {
        Route::get('/', IndexController::class)->name('admin.posts.index');
        Route::get('/create', CreateController::class)->name('admin.posts.create');
        Route::post('/', StoreController::class)->name('admin.posts.store');
        Route::get('/{post}', ShowController::class)->name('admin.posts.show');
        Route::get('/{post}/edit', EditController::class)->name('admin.posts.edit');
        Route::patch('/{post}', UpdateController::class)->name('admin.posts.update');
        Route::delete('/{post}', DestroyController::class)->name('admin.posts.destroy');
    });

    Route::group(['namespace' => 'Category', 'prefix' => 'categories'], function () {
        Route::get('/', IndexController::class)->name('admin.categories.index');
        Route::get('/create', CreateController::class)->name('admin.categories.create');
        Route::post('/', StoreController::class)->name('admin.categories.store');
        Route::get('/{category}', ShowController::class)->name('admin.categories.show');
        Route::get('/{category}/edit', EditController::class)->name('admin.categories.edit');
        Route::patch('/{category}', UpdateController::class)->name('admin.categories.update');
        Route::delete('/{category}', DestroyController::class)->name('admin.categories.destroy');
    });

    Route::group(['namespace' => 'Tag', 'prefix' => 'tags'], function () {
        Route::get('/', IndexController::class)->name('admin.tags.index');
        Route::get('/create', CreateController::class)->name('admin.tags.create');
        Route::post('/', StoreController::class)->name('admin.tags.store');
        Route::get('/{tag}', ShowController::class)->name('admin.tags.show');
        Route::get('/{tag}/edit', EditController::class)->name('admin.tags.edit');
        Route::patch('/{tag}', UpdateController::class)->name('admin.tags.update');
        Route::delete('/{tag}', DestroyController::class)->name('admin.tags.destroy');
    });

    Route::group(['namespace' => 'User', 'prefix' => 'users'], function () {
    Route::get('/', IndexController::class)->name('admin.users.index');
        Route::get('/create', CreateController::class)->name('admin.users.create');
        Route::post('/', StoreController::class)->name('admin.users.store');
        Route::get('/{user}', ShowController::class)->name('admin.users.show');
        Route::get('/{user}/edit', EditController::class)->name('admin.users.edit');
        Route::patch('/{user}', UpdateController::class)->name('admin.users.update');
        Route::delete('/{user}', DestroyController::class)->name('admin.users.destroy');
    });
});

Auth::routes(['verify' => true]);
