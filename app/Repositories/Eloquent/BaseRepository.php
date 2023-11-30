<?php

namespace App\Repositories\Eloquent;

use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes = []): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * Get all models.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->get();
    }

    /**
     * @param $id
     *
     * @return Model
     */
    public function find(int $id = 0): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * Get model by slug.
     *
     * @param  string  $slug
     * @return Model|null
     */
    public function findBySlug(string $slug): ?Model
    {
        return $this->model->where('slug', $slug)->first();
    }

    /**
     * @param $id
     *
     * @return Model
     */
    public function update(int $id = 0, array $attributes = []): Model
    {
        $this->model->find($id)->update($attributes);
        return $this->model;
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function delete(Model $model): bool
    {
        return $model->delete();
    }

    /**
     * Handle pagination
     *
     * @param  int  $perPage
     * @param  array  $columns
     * @param  string  $pageName
     * @param  [type]  $page
     *
     * @return LengthAwarePaginator
     */
    public function paginate($perPage = 15, $columns = ['*'], $pageName = 'page', $page = null): LengthAwarePaginator
    {
        return $this->model->paginate($perPage, $columns, $pageName, $page);
    }

    /**
     * Generates a slug from a given name.
     *
     * @param string $name
     * @return string
     */
    protected function generateSlug(string $name): string
    {
        return Str::slug($name);
    }
}
