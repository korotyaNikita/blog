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
    Route::get('/', IndexController::class);
});

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin'], function () {
    Route::group(['namespace' => 'Main'], function () {
        Route::get('/', IndexController::class);
    });

    Route::group(['namespace' => 'Category', 'prefix' => 'categories'], function () {
        Route::get('/', IndexController::class)->name('admin.categories.index');
        Route::get('/create', CreateController::class)->name('admin.categories.create');
        Route::post('/', StoreController::class)->name('admin.categories.store');
        Route::get('/{category}', ShowController::class)->name('admin.categories.show');
        Route::get('/{category}/edit', EditController::class)->name('admin.categories.edit');
        /*Route::patch('/{category}', UpdateController::class)->name('admin.categories.update');
        Route::delete('/{category}', DestroyController::class)->name('admin.categories.destroy');*/
    });
});

Auth::routes();
