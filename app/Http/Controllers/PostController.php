<?php

namespace App\Http\Controllers;

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
        $posts = Post::with('tags')->get();
        return response()->json($posts);
    }

    /**
     * POST an instance of the Post model
     */
    public function post(Request $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');
        
        $post = Post::create([
            'title' => $title,
            'content' => $content
        ]);

        if ($post->exists) {
            return response()->json($post);
        } else {
            return false;
        }
    }

    public function patch(Request $request)
    {

    }

    public function delete(Request $request)
    {
        
    }
}
