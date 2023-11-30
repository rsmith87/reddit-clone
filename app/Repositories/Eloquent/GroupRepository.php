<?php

namespace App\Repositories\Eloquent;

use App\Models\Group;
use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use App\Events\PostCreated;


class GroupRepository extends BaseRepository implements EloquentRepositoryInterface
{
    /**
     * The post object.
     */
    protected Group $group;

    /**
     * Class constructor.
     */
    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    public function all(): Collection
    {
        return $this->group->get();
    }

    public function find(int $id = 0): ?Group
    {
        $this->group = $this->group::findOrFail($id);

        return $this->group;
    }

    public function findBySlug(string $slug): ?Group
    {
        return $this->group->where('slug', $slug)->first();
    }

    public function create(array $data = []): Group
    {
        $this->group = new Group;
        $this->group->fill($data);
        $this->group->slug = $this->generateSlug($data['name']);
        $this->group->save();

        return $this->group;
    }

    public function update(int $id = 0, array $data = []): Group
    {
        $this->group = $this->group::findOrFail($id);
        $this->group->fill($data);
        $this->group->slug = $this->generateSlug($data['name']);
        $this->group->save();

        return $this->group;
    }
}
