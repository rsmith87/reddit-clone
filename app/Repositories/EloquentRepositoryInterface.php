<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface EloquentRepositoryInterface
 */
interface EloquentRepositoryInterface
{
    /**
     * Create the model.
     */
    public function create(array $attributes = []): Model;

    /**
     * Find the model.
     */
    public function find(int $id = 0): ?Model;

    /**
     * Update the model.
     */
    public function update(int $id = 0, array $attributes = []): Model;

    /**
     * Delete the model.
     */
    public function delete(Model $model): bool;

    /**
     * Paginate the models
     *
     * @param  array  $columns
     * @param  string  $pageName
     * @param  int  $page
     */
    public function paginate(int $perPage = 15, $columns = ['*'], $pageName = 'page', $page = null): LengthAwarePaginator;
}
