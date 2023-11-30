<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use App\Models\Post;
use App\Repositories\Eloquent\TagRepository;
use App\Http\Resources\TagCollection;
use App\Http\Resources\PostCollection;


class TagController extends Controller
{
    protected TagRepository $tagRepository;

    /**
     * Create a new controller instance.
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * Return all instances of the model.
     */
    public function index()
    {
        $tags = $this->tagRepository->all();

        return new TagCollection($tags);
    }

    /**
     * Return a single instance of the model.
     */
    public function findBySlug($slug)
    {
        $tag = $this->tagRepository->findBySlug($slug);

        return new TagResource($tag);
    }

    /**
     * Create a new instance of the model.
     */
    public function store(TagRequest $tagRequest)
    {
        $validated = $tagRequest->validated();

        $tag = $this->tagRepository->create($validated);

        return new TagResource($tag);
    }

    /**
     * Update a single instance of the model.
     */
    public function patch(TagRequest $tagRequest, $slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $tag = $this->tagRepository->update($tag->id, $tagRequest->validated());

        return new TagResource($tag);
    }

    /**
     * Get posts associated with a tag.
     */
    public function getPostsByTagSlug(Tag $tag)
    {
        $tag = Tag::where('slug', $tag->slug)->firstOrFail();
        $posts = $tag->posts()->paginate(10);

        return new PostCollection($posts);}

    /**
     * Associate a tag with a post.
     */
    public function associateTagWithPost(Tag $tag, Post $post)
    {
        $tag = Tag::where('slug', $tag->slug)->firstOrFail();
        $post->tags()->attach($tag);

        return response()->json([
            'message' => 'Tag associated with post',
        ], 200);
    }

    /**
     * Detach a tag from a post.
     */
    public function disassociateTagFromPost(Tag $tag, Post $post)
    {
        $tag = Tag::where('slug', $tag->slug)->firstOrFail();
        $post->tags()->detach($tag->post_id);

        return response()->json([
            'message' => 'Tag detached from post',
        ], 200);
    }

    /**
     * Delete a single instance of the model.
     */
    public function delete($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $this->tagRepository->delete($tag);

        return response()->json(null, 204);
    }
    
}
