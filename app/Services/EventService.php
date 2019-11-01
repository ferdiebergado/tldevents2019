<?php

declare(strict_types=1);

namespace App\Services;

use App\Event;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EventRequest;

class EventService
{
    /**
     * Save an event.
     *
     * @param EventRequest $request
     * @param string $task
     * @param Event $event
     * @return Event
     */
    public function save(EventRequest $request, string $task, Event $event = null): Event
    {
        $is_active = $request->has('is_active');
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            if ($is_active) {
                $active = Event::whereCreatedBy(auth()->id())->whereIsActive(true)->first();
                if ($active) {
                    $active->update(['is_active' => false]);
                }
            }
            if ($task === 'store') {
                $model = Event::firstOrCreate($validated, compact('is_active'));
            }
            if ($task === 'update') {
                $updates = array_merge($validated, compact('is_active'));
                $event->update($updates);
                $model = $event;
            }
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return $model;
    }
}
