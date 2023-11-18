<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repositories\Eloquent\PostRepository;
use App\Services\PostService;
use Illuminate\Http\Request;

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
     * @return string
     */
    public function index()
    {
        $posts = $this->postRepository->all();
        $posts->load(['postComments', 'postStatistics']);

        return response()->json(PostResource::collection($posts));
    }

    public function findBySlug($slug)
    {
        $posts = $this->postRepository->findBySlug($slug);
        $posts->load(['postComments', 'postStatistics']);

        return response()->json($posts);
    }

    /**
     * POST an instance of the Post model
     */
    public function store(PostRequest $request, PostService $service)
    {
        $validated = $request->validated();

        $post = $service->store(
            $request['title'],
            PostStatus::PUBLISHED,
            $request['content'],
            $request['slug']
        );

        return response()->json($post);
    }

    public function patch(PostRequest $postRequest)
    {
        $postRequest->user()->posts()->update($postRequest->validated());

        return response()->json($postRequest->all());
    }

    public function delete(Request $request, Post $post)
    {
        $this->authorize('destroy', $post);

        $post->delete();

        return response()->json(['Post deleted'], 200);
    }
}
