<?php

namespace App\Http\Controllers;

use App\Event;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EventRequest;
use App\Services\EventService;

class EventController extends Controller
{
    private $service;

    public function __construct(EventService $service)
    {
        $this->authorizeResource(Event::class, 'event');
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $role = auth()->user()->role;

        if ($role === 1) {
            $model = Event::all();
        }

        if ($role === 2) {
            $model = Event::whereCreatedBy(auth()->id())->get();
        }

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
        $model = $eventService->save($request, 'update', $event);

        // $is_active = $request->has('is_active');
        // $validated = $request->validated();
        // $updates = array_merge($validated, compact('is_active'));
        // $event->update($updates);

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
