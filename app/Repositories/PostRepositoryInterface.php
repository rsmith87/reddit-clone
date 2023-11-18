<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface PostRepositoryInterface extends EloquentRepositoryInterface
{
    public function all(): Collection;

    public function find(int $id = 0): ?Model;

    public function findBySlug(string $slug): ?Model;

    public function paginate(int $perPage = 15, $columns = ['*'], $pageName = 'page', $page = null): LengthAwarePaginator;
}
