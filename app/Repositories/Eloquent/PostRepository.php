<?php

namespace App\Repositories\Eloquent;

use App\Events\PostCreated;
use App\Events\PostUpdated;
use App\Events\PostViewed;
use App\Enums\PostStatus;
use App\Models\Post;
use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository extends BaseRepository implements EloquentRepositoryInterface
{
    /**
     * The post object.
     */
    protected Post $post;

    /**
     * Class constructor.
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function all(): Collection
    {
        return $this->post->get();
    }

    public function find(int $id = 0): ?Post
    {
        $this->post = $this->post::findOrFail($id);
        $this->post->load(['comments', 'statistics', 'votes']);

        PostViewed::dispatch($this->post);

        return $this->post;
    }

    public function findBySlug(string $slug): ?Post
    {
        $this->post = Post::where('slug', $slug)->first();
        $this->post->load(['comments', 'statistics', 'votes']);

        PostViewed::dispatch($this->post);

        return $this->post;
    }

    public function getPopular(): LengthAwarePaginator
    {
        //$userSettings = session('userSettings'); // TODO: Fix this - it's not working
        return $this->post->popular()->paginate(5);
    }

    public function getByUser(int $userId = 0): LengthAwarePaginator
    {
        return $this->post->where('user_id', $userId)->paginate(5);
    }

    public function create(array $data = []): Post
    {
        $this->post = new Post;
        $this->post->fill($data);
        $this->post->status = PostStatus::PUBLISHED;
        $this->post->slug = $this->generateSlug($data['title']);
        $this->post->user_id = auth()->user()->id;
        $this->post->save();

        PostCreated::dispatch($this->post);

        return $this->post;
    }

    public function patch(Post $post, array $data = []): Post
    {
        $this->post = $post;
        $this->post->update($data);

        PostUpdated::dispatch($this->post);

        return $this->post;
    }

    public function paginate($perPage = 15, $columns = ['*'], $pageName = 'page', $page = null): LengthAwarePaginator
    {
        return $this->post->paginate($perPage, $columns, $pageName, $page);
    }
}
