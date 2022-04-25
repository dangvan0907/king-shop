<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    public $model;
    abstract public function model();
    public function __construct()
    {
        $this->model = app($this->model());
    }

    /**
     * Retrieve all data of repository
     * @return Collection|Model[] `
     */
    public function all()
    {
        return $this->model->all();
    }

    public function count()
    {
        return $this->model->count();
    }
    /**
     * Retrieve all data of repository, paginated
     * @param null $limit
     * @param array $columns
     * @return
     */
    public function paginate($limit = 5, $columns = ['*'])
    {
        $limit = is_null($limit) ? config('repository.pagination.limit', 10) : $limit;

        return $this->model->paginate($limit, $columns);
    }

    /**
     * Find data by id
     * @param $id
     * @param array $columns
     * @return
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    public function findWithoutRedirect($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    public function findOrFail($id, $columns = ['*'])
    {
        return $this->model->findOrFail($id);
    }

    public function findOrFailWithTrashed($id, $columns = ['*'])
    {
        return $this->model->withTrashed()->findOrFail($id);
    }

    /**
     * Save a new entity in repository
     * @param array $input
     * @return
     */
    public function create(array $input)
    {
        return $this->model->create($input);
    }

    /**
     * Update a entity in repository by id
     * @param array $input
     * @param $id
     * @return BaseRepository
     */
    public function update(array $input, $id)
    {
        $model = $this->model->findOrFail($id);
        $model->fill($input);
        $model->save();

        return $model;
    }

    /**
     * Delete a entity in repository by id
     *
     * @param $id
     *
     * @return int
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function multipleDelete(array $ids)
    {
        return $this->model->destroy(array_values($ids));
    }

    public function latest($id)
    {
        return $this->model->latest('id');
    }

    public function updateOrCreate(array $arrayFind, $arrayCreate = ['*'])
    {
        return $this->model->updateOrCreate($arrayFind, $arrayCreate);
    }

    public function insertMany($data)
    {
        return count($data) > 0 ? $this->model->insert($data) : null;
    }
}
