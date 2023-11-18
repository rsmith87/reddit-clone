<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user()->with('posts')->with('comments')->get();
});

Route::controller(AuthController::class)
    ->group(function () {
        Route::post('login', 'login')->name('login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('v1')->group(function () {
        Route::controller(PostController::class)
            ->prefix('posts')
            ->group(function () {
                Route::get('', 'index')->name('post.index');
                Route::post('', 'store')->name('post.store');

                Route::prefix('{slug}')
                    ->group(function () {
                        Route::get('', 'findBySlug');
                        Route::patch('', 'patch');
                        Route::delete('', 'delete');
                });
        });

        Route::controller(PostCommentController::class)
            ->prefix('posts/{slug}/comments')
            ->group(function () {
                Route::get('', 'getCommentsBySlug');
                Route::post('', 'store');
        });



        Route::controller(TagController::class)
            ->prefix('tags')
            ->group(function () {
                Route::get('', 'index');
                Route::post('', 'store');

                Route::prefix('{slug}')
                    ->group(function () {
                        Route::get('', 'findBySlug');
                        Route::patch('', 'patch');
                        Route::delete('', 'delete');
                });
        });

        Route::controller(MailController::class)
            ->prefix('mail')
            ->group(function () {
                Route::post('', 'sendMail');
                Route::post('cancel', 'sendCancelAccountMail');
            }
        );

        Route::get('tags', [TagController::class, 'get']);
        Route::get('media', [MediaController::class, 'get']);

        Route::post('media', [MediaController::class, 'post']);
    });
});
