<?php

namespace App\Http\Controllers;

use App\Participant;
use Illuminate\Http\Request;
use App\Http\Requests\ParticipantRequest;
use App\Services\ParticipantService;

class ParticipantController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Participant::class, 'participant');
    }

    /**
     * Display a listing of the participant.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request, ParticipantService $service)
    {
        $search = null;

        if ($request->has('search')) {
            $search = $request->search;
        }

        $model = $service->fetchAll($search);

        if ($request->wantsJson()) {
            return response()->json([
                'data' => $model
            ]);
        }

        return view('participant.index', compact('model'));
    }

    /**
     * Show the form for creating a new participant.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = new Participant();
        $task = 'create';

        return view('participant.form', compact('model', 'task'));
    }

    /**
     * Store a newly created participant in storage.
     *
     * @param  \App\Http\Requests\ParticipantRequest  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(ParticipantRequest $request, ParticipantService $service)
    {
        $validated = $request->validated();

        $participant = $service->store($validated);

        session()->flash('success', __('messages.success'));
        return redirect()->route('participants.show', $participant);
    }

    /**
     * Display the specified participant.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\View\View
     */
    public function show(Participant $participant)
    {
        return view('participant.show', ['model' => $participant]);
    }

    /**
     * Show the form for editing the specified participant.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\View\View
     */
    public function edit(Participant $participant)
    {
        return view('participant.form', ['model' => $participant, 'task' => 'edit']);
    }

    /**
     * Update the specified participant in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Participant  $participant
     * @return \Illuminate\Routing\Redirector
     */
    public function update(ParticipantRequest $request, Participant $participant, ParticipantService $service)
    {
        $service->update($participant->id, $request->validated());

        session()->flash('info', __('messages.updated'));

        return redirect()->route('participants.show', $participant);
    }

    /**
     * Remove the specified participant from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Participant  $participant
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Participant $participant)
    {
        $request->validate(['participant_id' => 'required']);

        if ($request->get('participant_id') == $participant->id && $participant->delete()) {
            return redirect()->route('participants.index');
        }

        return back();
    }

    /**
     * Show the search form.
     *
     * @return \Illuminate\View\View
     */
    public function search()
    {
        return view('participant.search');
    }

    public function showAddToEventForm(Participant $participant)
    {
        return view('participant.form', ['model' => $participant, 'task' => 'addtoevent']);
    }

    public function addToEvent(ParticipantRequest $request, Participant $participant, ParticipantService $service)
    {
        $participant = $service->addToEvent($participant->id, $request->validated());

        session()->flash('info', __('messages.addedToEvent'));

        return redirect()->route('participants.show', $participant);
    }

    /**
     * Show the form for creating a new participant with add to event fields.
     *
     * @return \Illuminate\View\View
     */
    public function createAndAddToEvent()
    {
        $model = new Participant();
        $task = 'addtoevent';

        return view('participant.form', compact('model', 'task'));
    }
}
