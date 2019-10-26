<?php

namespace App\Http\Controllers;

use App\Participant;
use Illuminate\Http\Request;
use App\Http\Requests\ParticipantRequest;
use Illuminate\Support\Arr;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the participant.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $model = Participant::orderBy('last_name')->orderBy('first_name')->get();

        if ($request->isXmlHttpRequest()) {
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
    public function store(ParticipantRequest $request)
    {
        $validated = $request->validated();
        $participant = Participant::firstOrCreate(Arr::only($validated, ['last_name', 'first_name', 'mi', 'sex']), Arr::only($validated, ['station', 'mobile', 'email']));
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
        return view('participant.show', ['model' => $participant, 'task' => 'show']);
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
    public function update(ParticipantRequest $request, Participant $participant)
    {
        $participant->update($request->validated());

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
        $this->authorize('delete', $participant);

        $request->validate(['participant_id' => 'required']);

        if ($request->get('participant_id') == $participant->id && $participant->delete()) {
            return redirect()->route('participants.index');
        }

        return back();
    }
}
