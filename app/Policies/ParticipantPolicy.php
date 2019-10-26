<?php

namespace App\Policies;

use App\User;
use App\Participant;
use Illuminate\Auth\Access\HandlesAuthorization;

class ParticipantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the participant.
     *
     * @param  \App\User  $user
     * @param  \App\Participant  $participant
     * @return mixed
     */
    public function view(User $user, Participant $participant)
    {
        // Update $user authorization to view $participant here.
        return true;
    }

    /**
     * Determine whether the user can create participant.
     *
     * @param  \App\User  $user
     * @param  \App\Participant  $participant
     * @return mixed
     */
    public function create(User $user, Participant $participant)
    {
        // Update $user authorization to create $participant here.
        return true;
    }

    /**
     * Determine whether the user can update the participant.
     *
     * @param  \App\User  $user
     * @param  \App\Participant  $participant
     * @return mixed
     */
    public function update(User $user, Participant $participant)
    {
        // Update $user authorization to update $participant here.
        return true;
    }

    /**
     * Determine whether the user can delete the participant.
     *
     * @param  \App\User  $user
     * @param  \App\Participant  $participant
     * @return mixed
     */
    public function delete(User $user, Participant $participant)
    {
        // Update $user authorization to delete $participant here.
        return true;
    }
}
