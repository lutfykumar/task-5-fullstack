<?php

use App\Http\Controllers\Api\ArticlesController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoriesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::post('posts/create', [ArticlesController::class, 'create']);
    Route::post('posts/list-all', [ArticlesController::class, 'listAll']);
    Route::post('posts/show-detail', [ArticlesController::class, 'showDetail']);
    Route::post('posts/update', [ArticlesController::class, 'update']);
    Route::post('posts/delete', [ArticlesController::class, 'delete']);

    Route::post('categories/create', [CategoriesController::class, 'create']);
    Route::post('categories/list-all', [CategoriesController::class, 'listAll']);
    Route::post('categories/show-detail', [CategoriesController::class, 'showDetail']);
    Route::post('categories/update', [CategoriesController::class, 'update']);
    Route::post('categories/delete', [CategoriesController::class, 'delete']);
});
