<?php

namespace App\Repositories;

use App\Event;
use App\Repositories\EloquentBaseRepository;
use App\Repositories\EventRepositoryInterface;

class EventEloquentRepository extends EloquentBaseRepository implements EventRepositoryInterface
{
    /**
     * EventEloquentRepository Constructor
     *
     * @param Event $model
     */
    public function __construct(Event $model)
    {
        parent::__construct($model);
    }

    /** @inheritDoc */
    public function activeByAuthUser()
    {
        return $this->model->whereUpdatedBy(auth()->id())->whereIsActive(true)->latest()->first();
    }

    /** @inheritDoc */
    public function latest($timestamp = 'created_at')
    {
        return $this->model->latest($timestamp)->get();
    }
}
