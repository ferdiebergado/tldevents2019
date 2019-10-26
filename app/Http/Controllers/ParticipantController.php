<?php

namespace App\Http\Controllers;

use App\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the participant.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $participantQuery = Participant::query();
        $participantQuery->where('name', 'like', '%'.request('q').'%');
        $participants = $participantQuery->paginate(25);

        return view('participants.index', compact('participants'));
    }

    /**
     * Show the form for creating a new participant.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', new Participant);

        return view('participants.create');
    }

    /**
     * Store a newly created participant in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Participant);

        $newParticipant = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $newParticipant['creator_id'] = auth()->id();

        $participant = Participant::create($newParticipant);

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
        return view('participants.show', compact('participant'));
    }

    /**
     * Show the form for editing the specified participant.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\View\View
     */
    public function edit(Participant $participant)
    {
        $this->authorize('update', $participant);

        return view('participants.edit', compact('participant'));
    }

    /**
     * Update the specified participant in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Participant  $participant
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Participant $participant)
    {
        $this->authorize('update', $participant);

        $participantData = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $participant->update($participantData);

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
