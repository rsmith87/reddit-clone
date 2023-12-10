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
     * @return PostCollection
     */
    public function index(): PostCollection
    {
        $this->authorize('view', Post::class);
        $posts = $this->postRepository->paginate();
        $posts->load(['comments', 'statistics', 'user', 'votes']);
        $posts->loadMissing(['comments.user']);

        return new PostCollection($posts);
    }

    public function getPopularPosts(): PostCollection
    {
        $this->authorize('view', Post::class);
        $posts = $this->postRepository->getPopular();

        return new PostCollection($posts);
    }

    public function findById(Post $post): PostResource
    {
        $this->authorize('view', Post::class);
        $post = $this->postRepository->find($post->id);

        return new PostResource($post);
    }

    public function findBySlug(Post $post): PostResource
    {
        $this->authorize('view', Post::class);

        $post = $this->postRepository->findBySlug($post->slug);


        return new PostResource($post);
    }

    public function store(PostRequest $request): PostResource
    {
        $this->authorize('create', [Post::class, $request->user()]);

        $post = $this->postRepository->create($request->validated());

        return new PostResource($post);
    }

    public function patch(PostRequest $postRequest, Post $post)
    {
        $this->authorize('update', $post);

        $post = $this->postRepository->patch($post, $postRequest->validated());

        return new PostResource($post);
    }

    public function delete(PostRequest $postRequest, Post $post)
    {
        $this->authorize('destroy', $post);

        $post->delete();

        return response()->json(['Post deleted'], 200);
    }
}
