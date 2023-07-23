<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Contracts\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface
{
    public $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all data from database
     *
     * @param  array $with
     *
     * @return object
     */
    public function fetchAll(array $with = []): object
    {
        $rows = $this->model::query();
        if ($with != []) {
            $rows = $rows->with($with);
        }

        return $rows->get();
    }

    /**
     * Get object or redirect to 404.
     *
     * @param  mixed $id
     * @param  mixed $with
     *
     * @return object
     */
    public function fetch(string $id, array $with = []): object
    {

        $rows = $this->model::query();
        if ($with != []) {
            $rows = $rows->with($with);
        }

        return $rows->findOrFail($id);
    }

    /**
     * store data in database
     *
     * @param  array $data
     *
     * @return object
     */
    public function store(array $data): object
    {
        return $this->model->create($data);
    }

    /**
     * Query database with id and update.
     *
     * @param  array $data
     * @param  string $id
     *
     * @return object
     */
    public function update(array $data, string $id): object
    {

        $updated = $this->model->whereId($id)->firstOrFail();
        $updated->update($data);

        return $updated;
    }

    /**
     * Query database with id and delete.
     *
     * @param string $id
     *
     * @return object
     */
    public function delete(string $id): object
    {
        $deleted = $this->fetch($id);
        $deleted->delete();

        return $deleted;
    }

    /**
     * Sync relations
     *
     * It dose not requires any event
     *
     * @param object $model
     * @param string $relation
     * @param mixed $attributes
     * @param boolean $detaching
     *
     * @return object
     */
    public function sync(
        object $model,
        string $relation,
        mixed $attributes,
        bool $detaching = true
    ): object {
        $model->{$relation}()->sync($attributes, $detaching);
        return $model;
    }
}
