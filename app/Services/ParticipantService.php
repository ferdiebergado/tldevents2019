<?php

namespace App\Services;

use App\Participant;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\EventRepositoryInterface;
use App\Repositories\ParticipantRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;

class ParticipantService
{
    private $participantRepository;
    private $eventRepository;
    private $transactionRepository;

    public function __construct(ParticipantRepositoryInterface $participantRepository, EventRepositoryInterface $eventRepository, TransactionRepositoryInterface $transactionRepository)
    {
        $this->participantRepository = $participantRepository;
        $this->eventRepository = $eventRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function fetchAll(string $search = null)
    {
        // If there's a search query, show the results.
        if ($search) {
            return $this->participantRepository->search($search);
        }

        $user_id = auth()->id();

        // If user is an admin, show all participants.
        if ($user_id === 1) {
            return $this->participantRepository->orderedByName();
        }

        // If user is an encoder, show only participants from the active event.
        if ($user_id === 2) {
            $model = new Participant();
            $currentEvent = $this->getCurrentEvent();
            if ($currentEvent) {
                $transactions = $this->transactionRepository->findByEventWithParticipant($currentEvent->id);
                $model = $transactions->map(function ($t) {
                    return $t->participant;
                });
            }
            return $model;
        }
    }

    public function store($attributes)
    {
        return $this->participantRepository->firstOrCreate(Arr::only($attributes, ['last_name', 'first_name', 'mi', 'sex']), Arr::only($attributes, ['station', 'mobile', 'email']));
    }

    public function update($id, $attributes)
    {
        return $this->participantRepository->update($id, $attributes);
    }

    public function addToEvent($id, $attributes)
    {
        DB::beginTransaction();
        try {
            if ($this->participantRepository->find($id)) {
                $participant = $this->participantRepository->update($id, Arr::except($attributes, ['role', 'learning_area', 'language']));
            } else {
                $participant = $this->store($attributes);
            }
            $this->transactionRepository->firstOrCreate(['participant_id' => $participant->id, 'event_id' => $this->getCurrentEvent()->id, 'participant_role_id' => $attributes['participant_role_id']], Arr::only($attributes, ['learning_area_id', 'language_id']));
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return $participant;
    }

    private function getCurrentEvent()
    {
        return $this->eventRepository->activeByAuthUser();
    }
}
