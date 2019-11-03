<?php

namespace App\Repositories;

use App\BaseModel;
use App\Repositories\BaseRepositoryInterface;

abstract class EloquentBaseRepository implements BaseRepositoryInterface
{
    protected $model = null;

    public function __construct(BaseModel $model)
    {
        $this->model = $model;
    }

    /** @inheritDoc */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /** @inheritDoc */
    public function create($attributes)
    {
        return $this->model->create($attributes);
    }

    /** @inheritDoc */
    public function firstOrCreate($attributesToCheck, $attributes)
    {
        return $this->model->firstOrCreate($attributesToCheck, $attributes);
    }

    /** @inheritDoc */
    public function update($id, $attributes)
    {
        $model = $this->find($id);
        $model->update($attributes);

        return $model;
    }

    /** @inheritDoc */
    public function updateOrCreate($attributes, $values)
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

    /** @inheritDoc */
    public function search($search)
    {
        return $this->model->search($search)->get();
    }
}
