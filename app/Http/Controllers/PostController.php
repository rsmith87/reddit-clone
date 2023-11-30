<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repositories\Eloquent\PostRepository;
use App\Events\PostCreated;

class PostController extends Controller
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Returns all instances of the model
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $this->authorize('view', Post::class);
        $posts = $this->postRepository->all();
        $posts->load(['postComments', 'postStatistics']);

        return new PostCollection($posts);
    }

    public function getPopularPosts()
    {
        $this->authorize('view', Post::class);
        $posts = $this->postRepository->getPopular();
        $posts->load(['postComments', 'postStatistics']);

        return new PostCollection($posts);
    }

    public function findBySlug($slug)
    {
        $this->authorize('view', Post::class);
        $posts = $this->postRepository->findBySlug($slug);
        $posts->load(['postComments', 'postStatistics']);

        return new PostResource($posts);
    }

    public function store(PostRequest $postRequest)
    {
        $this->authorize('create', [Post::class, $postRequest->user()]);
        $validated = $postRequest->validated();

        $post = $this->postRepository->create($validated);

        event(new PostCreated($post));

        return new PostResource($post);
    }

    public function patch(PostRequest $postRequest, Post $post)
    {
        $this->authorize('update', $post);
        $postRequest->user()->posts()->update($postRequest->validated());

        return response()->json($postRequest->all());
    }

    public function delete(PostRequest $postRequest, Post $post)
    {
        $this->authorize('destroy', $post);

        $post->delete();

        return response()->json(['Post deleted'], 200);
    }
}
