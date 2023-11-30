<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCommentRequest;
use App\Http\Requests\PostCommentByPostSlugRequest;
use App\Models\PostComment;
use App\Repositories\Eloquent\PostCommentRepository;
use App\Http\Resources\PostCommentResource;
use App\Http\Resources\PostCommentCollection;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    protected PostCommentRepository $postCommentRepository;

    public function __construct(PostCommentRepository $postCommentRepository)
    {
        $this->postCommentRepository = $postCommentRepository;
    }

    /**
     * Get all comments for a post by post slug.
     *
     * @param  [type]  $slug
     * @return PostCommentCollection
     */
    public function getCommentsByPostSlug(Request $request, $slug)
    {
        $this->authorize('view', [PostComment::class, $request->user()]);
        $comments = $this->postCommentRepository->findByPostSlug($slug);

        return new PostCommentCollection($comments);
    }

    /**
     * Store a new comment for a post by post slug.
     *
     * @param  PostCommentByPostSlugRequest  $postCommentByPostSlugRequest
     * @param  string  $slug
     * @return PostCommentResource
     */
    public function storeCommentByPostSlug(PostCommentByPostSlugRequest $postCommentByPostSlugRequest, $slug)
    {
        $this->authorize('create', [PostComment::class, $postCommentByPostSlugRequest->user()]);

        $comment = $this->postCommentRepository->createByPostSlug($postCommentByPostSlugRequest->validated(), $slug);

        return new PostCommentResource($comment);
    }

    /**
     * Delete a comment by Comment.
     */
    public function delete(Request $request, $slug, PostComment $postComment)
    {
        $this->authorize('destroy', $postComment);

        $postComment->delete();

        return response()->json(['Comment deleted'], 200);
    }
}
