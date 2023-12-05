<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\ModelActions;
use App\Models\Post;
use App\Repositories\Eloquent\PostRepository;
use App\Events\PostCreated;
use App\Events\PostViewed;
use Illuminate\Support\Facades\Cache;


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
        $posts = $this->postRepository->paginate();
        $posts->load(['comments', 'statistics', 'reactions']);

        return new PostCollection($posts);
    }

    public function getPopularPosts()
    {
        $this->authorize('view', Post::class);
        $posts = $this->postRepository->getPopular();

        return new PostCollection($posts);
    }

    public function findById(Post $post): PostResource
    {
        $this->authorize('view', Post::class);
        $post = $this->postRepository->find($post->id);
        $post->load(['comments', 'statistics']);

        PostViewed::dispatch($post);

        return new PostResource($post);
    }

    public function findBySlug(Post $post): PostResource
    {
        $this->authorize('view', Post::class);
        $post = $this->postRepository->findBySlug($post->slug);
        $post->load(['comments', 'statistics']);

        PostViewed::dispatch($post);

        return new PostResource($post);
    }

    public function store(PostRequest $postRequest)
    {
        $this->authorize('create', [Post::class, $postRequest->user()]);
        $validated = $postRequest->validated();

        $post = $this->postRepository->create($validated);

        PostCreated::dispatch($post);

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
