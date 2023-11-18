<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCommentRequest;
use App\Models\PostComment;

class PostCommentController extends Controller
{
    /**
     * Undocumented function
     */
    public function index()
    {
        $comments = PostComment::latest()->paginate(10);

        return response()->json($comments);
    }

    public function getCommentsByPostSlug($slug)
    {
        $comments = PostComment::where('post_slug', $slug)->latest()->paginate(10);

        return response()->json($comments);
    }

    public function store(PostCommentRequest $request)
    {
        $post = PostComment::create($request->validated());

        return response()->json($post);
    }
}
