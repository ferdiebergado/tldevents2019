<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Services\EventService;

class EventController extends Controller
{
    /**
     * EventController Constructor
     */
    public function __construct()
    {
        $this->authorizeResource(Event::class, 'event');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, EventService $service)
    {
        $model = $service->fetchAll();

        if ($request->isXmlHttpRequest()) {
            return response()->json(
                ['data' => $model]
            );
        }

        return view('event.index', compact('model'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Event();
        $task = 'create';
        return view('event.form', compact('model', 'task'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request, EventService $eventService)
    {
        $model = $eventService->save($request, 'store');

        session()->flash('success', __('messages.success'));

        return redirect()->route('events.show', $model);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $event = Event::with(['creator', 'editor', 'destroyer'])->find($event->id);
        return view('event.show', ['model' => $event->toArray(), 'task' => 'show']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('event.form', ['model' => $event, 'task' => 'edit']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Event $event, EventService $eventService)
    {
        $model = $eventService->save($request, 'update', $event->id);

        session()->flash('info', __('messages.updated'));

        return redirect()->route('events.show', $model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
