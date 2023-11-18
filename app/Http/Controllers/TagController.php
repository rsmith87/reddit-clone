<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TagController extends Controller
{
    /**
     * Return all instances of the model.
     */
    public function get()
    {
        return new TagResource(Tag::all());
    }

    /**
     * Return a single instance of the model.
     */
    public function findBySlug($slug)
    {
        return new TagResource(Tag::where('slug', $slug)->firstOrFail());
    }

    /**
     * Update a single instance of the model.
     */
    public function patch(TagRequest $tagRequest, $slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $tag->update($tagRequest->all());

        return new TagResource($tag);
    }

    /**
     * Delete a single instance of the model.
     */
    public function delete($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->get();
        $tag->delete();

        return response()->json(null, 204);
    }
    
}
