<?php

namespace App\Repositories\Eloquent;

use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

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
     * @param $id
     *
     * @return Model
     */
    public function find(int $id = 0): ?Model
    {
        return $this->model->find($id);
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
        return $this->model->destroy($model);
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
}
