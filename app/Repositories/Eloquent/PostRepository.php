<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    /**
     * The post object.
     */
    private Post $post;

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

    public function create(array $data = []): Post
    {
        return $this->post::create($data);
    }

    public function update(int $id = 0, array $data = []): Post
    {
        $this->post = $this->post::findOrFail($id);
        $this->post->update($data);

        return $this->post;
    }
}
