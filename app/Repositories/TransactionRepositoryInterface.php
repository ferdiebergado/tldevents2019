<?php

namespace App\Repositories;

interface TransactionRepositoryInterface
{
    public function findByEventWithParticipant(int $eventId);

    public function addParticipantToActiveEvent(int $participantId, int $eventId, int $roleId, int $learningAreaId = null, int $languageId = null);
}
