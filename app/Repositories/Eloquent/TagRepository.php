<?php

namespace App\Repositories\Eloquent;

use App\Enums\PostStatus;
use App\Models\Tag;
use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use App\Events\PostCreated;


class TagRepository extends BaseRepository implements EloquentRepositoryInterface
{
    /**
     * The post object.
     */
    protected Tag $tag;

    /**
     * Class constructor.
     */
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function all(): Collection
    {
        return $this->tag->get();
    }

    public function find(int $id = 0): ?Tag
    {
        $this->tag = $this->tag::findOrFail($id);

        return $this->tag;
    }

    public function findBySlug(string $slug): ?Tag
    {
        return $this->tag->where('slug', $slug)->first();
    }

    public function create(array $data = []): Tag
    {
        $this->tag = new Tag;
        $this->tag->fill($data);
        $this->tag->slug = $this->generateSlug($data['name']);
        $this->tag->save();

        return $this->tag;
    }
}
