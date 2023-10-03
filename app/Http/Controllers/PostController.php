<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Services\PostService;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Returns all instances of the model
     * 
     * @return string
     */
    public function get()
    {
        $posts = Post::with('tags')->paginate(2);
        return response()->json($posts);
    }

    /**
     * POST an instance of the Post model
     */
    public function post(PostRequest $request, PostService $service)
    {
        $post = $service->storePost(
            $request->title,
            $request->content
        );

        return response()->json($post);
    }

    public function patch(Request $request)
    {

    }

    public function delete(Request $request)
    {
        
    }
}
