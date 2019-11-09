<?php

declare(strict_types=1);

namespace App\Services;

use App\Event;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EventRequest;
use App\Repositories\EventRepositoryInterface;

class EventService
{
    /** @var \App\Repositories\EventRepositoryInterface */
    private $repository;

    /**
     * EventService Constructor
     *
     * @param EventRepositoryInterface $repository
     */
    public function __construct(EventRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Fetch all events
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fetchAll()
    {
        return $this->repository->latest();
    }

    /**
     * Save an event.
     *
     * @param EventRequest $request
     * @param string $task
     * @param in $eventId
     * 
     * @throws \Exception
     * 
     * @return Event
     */
    public function save(EventRequest $request, string $task, int $eventId = null): Event
    {
        $is_active = $request->has('is_active');
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            if ($is_active) {
                $active = $this->repository->activeByAuthUser();
                if ($active) {
                    $this->repository->update($active->id, ['is_active' => false]);
                }
            }
            if ($task === 'store') {
                $model = $this->repository->firstOrCreate($validated, compact('is_active'));
            }
            if ($task === 'update') {
                $updates = array_merge($validated, compact('is_active'));
                $model = $this->repository->update($eventId, $updates);
            }
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return $model;
    }
}
