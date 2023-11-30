<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository implements EloquentRepositoryInterface
{
    /**
     * UserRepositor constructor.
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }
}
