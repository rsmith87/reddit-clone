<?php

namespace App\Repositories\Eloquent;

use App\Enums\PostStatus;
use App\Models\Post;
use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use App\Events\PostCreated;


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

        return $this->post;
    }

    public function findBySlug(string $slug): ?Post
    {
        return $this->post->where('slug', $slug)->first();
    }

    public function getPopular(): LengthAwarePaginator
    {
        $userSettings = session('userSettings'); // TODO: Fix this - it's not working
        return $this->post->popular()->published()->paginate($userSettings['paginationSize'] ?? 5);
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

        return $this->post;
    }

    public function update(int $id = 0, array $data = []): Post
    {
        $this->post = $this->post::findOrFail($id);
        $this->post->update($data);

        return $this->post;
    }
}
