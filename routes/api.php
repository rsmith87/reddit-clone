<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MailTemplateController;
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

Route::middleware(['auth:sanctum'])
    ->prefix('v1')->group(function () {

        // User management.
        Route::controller(AuthController::class)
            ->prefix('auth')
            ->group(function () {
                Route::get('', 'user');
                Route::patch('', 'patchMe');
                Route::delete('', 'deleteMe');
        });

        // Post management.
        Route::controller(PostController::class)
            ->prefix('posts')
            ->group(function () {
                Route::get('', 'index')
                    ->name('post.index');
                Route::post('', 'store')
                    ->name('post.store');

                Route::prefix('{post:slug}')
                    ->group(function () {
                        Route::get('', 'findBySlug');
                        Route::patch('', 'patch');
                        Route::delete('delete', 'delete');
                });

                Route::get('popular', 'getPopularPosts')
                    ->name('post.popular');
        });

        Route::controller(PostCommentController::class)
            ->prefix('posts/{post:slug}/comments')
            ->group(function () {
                Route::get('', 'getCommentsByPostSlug');
                Route::post('', 'storeCommentByPostSlug');
                Route::post('store', 'storeCommentByPostSlug');
                Route::delete('{postComment}', 'delete');
        });

        Route::controller(TagController::class)
            ->prefix('tags')
            ->group(function () {
                Route::get('', 'index');
                Route::post('', 'store');

                Route::prefix('{tag}')
                    ->group(function () {
                        Route::get('', 'findBySlug');
                        Route::patch('', 'patch');
                        Route::delete('', 'delete');

                        Route::prefix('posts')
                            ->group(function () {
                                Route::get('', 'getPostsByTagSlug');
                            
                                Route::prefix('{post}')
                                    ->group(function () {
                                        Route::post('attach', 'associateTagWithPost');
                                        Route::post('detach', 'disassociateTagFromPost');
                                })->scopeBindings();
                        });
                });
        });

        Route::controller(MailController::class)
            ->prefix('mail')
            ->group(function () {
                Route::post('', 'sendWelcomeMail');
                Route::post('cancel', 'sendCancelAccountMail');
                Route::post('post', 'sendPostMail');
            }
        );

        Route::controller(MailTemplateController::class)
            ->prefix('mail-templates')
            ->group(function () {
                Route::get('', 'index');
                Route::post('', 'createMailTemplate');
                Route::patch('', 'editMailTemplate');
        
                Route::prefix('{id}')
                    ->group(function () {
                        Route::get('', 'find');
                        Route::delete('', 'delete');
                });
        });

        Route::controller(MediaController::class)
            ->prefix('media')
            ->group(function () {
                Route::get('', 'get');
                Route::post('', 'post');
        
                Route::prefix('{media}')
                    ->group(function () {
                        Route::get('', 'find');
                        Route::get('fetch', 'fetchMedia');
                        Route::delete('', 'delete');
                        
                        Route::get('modify', 'modify');
                });
            }
        );

        Route::controller(GroupController::class)
            ->prefix('groups')
            ->group(function () {
                Route::get('', 'index');
                Route::post('', 'store');
        
                Route::prefix('{slug}')
                    ->group(function () {
                        Route::get('', 'findBySlug');
                        Route::patch('', 'patch');
                        Route::delete('', 'delete');

                        Route::prefix('posts')
                            ->group(function () {
                                Route::get('', 'getPostsByGroupSlug');
                                Route::post('', 'storePostByGroupSlug');
                        });
                });
        });

        //Route::get('tags', [TagController::class, 'get']);
    });
