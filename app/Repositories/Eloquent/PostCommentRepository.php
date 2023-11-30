<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Models\PostComment;
use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PostCommentRepository extends BaseRepository implements EloquentRepositoryInterface
{
    /**
     * The post object.
     */
    protected PostComment $postComment;

    /**
     * Class constructor.
     */
    public function __construct(PostComment $postComment)
    {
        $this->postComment = $postComment;
    }

    public function all(): Collection
    {
        return $this->postComment->get();
    }

    public function find(int $id = 0): ?PostComment
    {
        $this->postComment = $this->postComment::findOrFail($id);

        return $this->postComment;
    }

    public function findByPostSlug(string $slug): ?Collection
    {
        $post = Post::where('slug', $slug)->first();
        $allCommentsForPost = $this->postComment::where('post_id', $post->id)->get();
        return $allCommentsForPost;
    }

    public function create(array $data = []): PostComment
    {
        $this->postComment = new PostComment;
        $this->postComment->fill($data);
        $this->postComment->user_id = auth()->user()->id;
        $this->postComment->post_id = $data['post_id'];
        $this->postComment->save();

        return $this->postComment;
    }

    public function createByPostSlug(array $data = [], string $slug): PostComment
    {
        $post = Post::where('slug', $slug)->first();
        $this->postComment = new PostComment;
        $this->postComment->fill($data);
        $this->postComment->user_id = auth()->user()->id;
        $this->postComment->post_id = $post->id;
        $this->postComment->save();

        return $this->postComment;
    }

    public function update(int $id = 0, array $data = []): PostComment
    {
        $this->postComment = $this->postComment::findOrFail($id);
        $this->postComment->update($data);

        return $this->postComment;
    }
}
