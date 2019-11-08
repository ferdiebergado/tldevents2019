<?php

namespace Tests\Unit\Policies;

use App\Participant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class ParticipantPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_participant()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new Participant));
    }

    /** @test */
    public function user_can_view_participant()
    {
        $user = $this->createUser();
        $participant = factory(Participant::class)->create();
        $this->assertTrue($user->can('view', $participant));
    }

    /** @test */
    public function user_can_update_participant()
    {
        $user = $this->createUser();
        $participant = factory(Participant::class)->create();
        $this->assertTrue($user->can('update', $participant));
    }

    /** @test */
    public function user_can_delete_participant()
    {
        $user = $this->createUser();
        $participant = factory(Participant::class)->create();
        $this->assertTrue($user->can('delete', $participant));
    }
}
