<?php

use App\Http\Controllers\TagController;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MediaController;
use App\Models\Post;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});

Route::middleware(['auth:sanctum'])->group(function() {
    Route::prefix('v1')->group(function() {
        Route::get('posts', function() {
            return new PostCollection(Post::all());
        });
        Route::get('tags', [TagController::class, 'get']);
        Route::get('media', [MediaController::class, 'get']);

        Route::post('posts', [PostController::class, 'post']);
        Route::post('media', [MediaController::class, 'post']);
    });
});
  