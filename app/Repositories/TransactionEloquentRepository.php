<?php

namespace App\Repositories;

use App\Transaction;
use App\Repositories\EloquentBaseRepository;
use App\Repositories\TransactionRepositoryInterface;

class TransactionEloquentRepository extends EloquentBaseRepository implements TransactionRepositoryInterface
{
    public function __construct(Transaction $transaction)
    {
        parent::__construct($transaction);
    }

    public function findByEventWithParticipant($eventId)
    {
        return $this->model->with('participant')->whereEventId($eventId)->get();
    }

    public function addParticipantToActiveEvent($participantId, $eventId, $roleId, $learningAreaId = null, $languageId = null)
    {
        return $this->model->create([
            'participant_id' => $participantId,
            'event_id' => $eventId,
            'role_id' => $roleId,
            'learning_area_id' => $learningAreaId,
            'language_id' => $languageId
        ]);
    }
}
