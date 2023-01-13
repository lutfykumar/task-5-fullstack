<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/c/{slug}', [HomeController::class, 'categorySlug'])->name('category.slug');
Route::get('/p/{slug}', [HomeController::class, 'postSlug'])->name('post.slug');
Route::post('/p/search', [HomeController::class, 'search'])->name('post.search');

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [AccountController::class, 'index'])->name('account');
    Route::post('/profile/update', [AccountController::class, 'update'])->name('account.update');
    Route::resource('post', PostController::class);
    Route::resource('category', CategoryController::class);
});
