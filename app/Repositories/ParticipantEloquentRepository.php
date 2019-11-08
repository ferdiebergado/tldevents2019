<?php

namespace App\Repositories;

use App\Participant;
use App\Repositories\EloquentBaseRepository;
use App\Repositories\ParticipantRepositoryInterface;

class ParticipantEloquentRepository extends EloquentBaseRepository implements ParticipantRepositoryInterface
{
    public function __construct(Participant $participant)
    {
        parent::__construct($participant);
    }

    public function orderedByName()
    {
        return $this->model->orderBy('last_name')->orderBy('first_name')->get();
    }

    public function search($search)
    {
        return $this->model->search($search)->get();
    }

    public function withUserStampBy(string $field, $value)
    {
        return $this->model->with(['creator', 'editor', 'destroyer'])->where($field, $value)->first();
    }
}
