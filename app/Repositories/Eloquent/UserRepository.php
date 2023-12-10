<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository implements EloquentRepositoryInterface
{
    public User $user;

    /**
     * UserRepositor constructor.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function all(): Collection
    {
        return $this->user->get();
    }

    public function find(int $id = 0): ?User
    {
        return $this->user->findOrFail($id);
    }

    public function findBySlug(string $slug): ?User
    {
        return $this->user->where('slug', $slug)->first();
    }

    public function create(array $data = []): User
    {
        $this->user = new User;
        $this->user->fill($data);
        $this->user->slug = $this->generateSlug($data['name']);
        $this->user->save();

        return $this->user;
    }

    public function update(array $data = []): User
    {
        $this->user->fill($data);
        $this->user->slug = $this->generateSlug($data['name']);
        $this->user->save();

        return $this->user;
    }

    public function delete(): bool
    {
        return $this->user->delete();
    }

    public function getUserPosts(): Collection
    {
        return $this->user->posts()->get();
    }

    public function getUserComments(): Collection
    {
        return $this->user->comments()->get();
    }
}
