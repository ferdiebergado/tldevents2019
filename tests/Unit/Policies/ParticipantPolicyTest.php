<?php

namespace Tests\Unit\Policies;

use Tests\TestCase;
use App\Participant;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipantPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @var \App\User */
    private $encoder;

    private $user;

    private $admin;

    /** @var \App\Participant */
    private $participant;

    /** @inheritDoc */
    protected function setUp(): void
    {
        parent::setUp();
        $this->encoder = factory(User::class)->states(['active', 'encoder'])->create();
        $this->user = factory(User::class)->state('active')->create();
        $this->admin = factory(User::class)->state('admin')->create();
        $this->participant = factory(Participant::class)->create();
    }

    /**
     * Test if an encoder can create a participant.
     *
     * @return void
     */
    public function testEncoderCanCreateAParticipant()
    {
        $this->assertTrue($this->encoder->can('create', new Participant()));
    }

    /**
     * Test if an encoder can view a participant.
     *
     * @return void
     */
    public function testEncoderCanViewAParticipant()
    {
        $this->assertTrue($this->encoder->can('view', $this->participant));
    }

    /**
     * Test if an encoder can view all participants.
     *
     * @return void
     */
    public function testEncoderCanViewAllParticipants()
    {
        $this->assertTrue($this->encoder->can('viewAny', $this->participant));
    }

    /**
     * Test if an encoder can update a participant.
     *
     * @return void
     */
    public function testEncoderCanUpdateAParticipant()
    {
        $this->assertTrue($this->encoder->can('update', $this->participant));
    }

    /**
     * Test if an encoder can delete a participant.
     *
     * @return void
     */
    public function testEncoderCanDeleteAParticipant()
    {
        $this->assertTrue($this->encoder->can('delete', $this->participant));
    }

    /**
     * Test if a user cannot create a participant.
     *
     * @return void
     */
    public function testUserCannotCreateAParticipant()
    {
        $this->assertFalse($this->user->can('create', new Participant()));
    }

    /**
     * Test if a user can view a participant.
     *
     * @return void
     */
    public function testUserCanViewAParticipant()
    {
        $this->assertTrue($this->user->can('view', $this->participant));
    }

    /**
     * Test if a user can view any participant.
     *
     * @return void
     */
    public function testUserCanViewAnyParticipant()
    {
        $this->assertTrue($this->user->can('viewAny', $this->participant));
    }

    /**
     * Test if a user cannot update a participant.
     *
     * @return void
     */
    public function testUserCannotUpdateAParticipant()
    {
        $this->assertFalse($this->user->can('update', $this->participant));
    }

    /**
     * Test if a user cannot delete a participant.
     *
     * @return void
     */
    public function testUserCannotDeleteAParticipant()
    {
        $this->assertFalse($this->user->can('delete', $this->participant));
    }

    /**
     * Test if an admin can create a participant.
     *
     * @return void
     */
    public function testAdminCanCreateAParticipant()
    {
        $this->assertTrue($this->admin->can('create', new Participant()));
    }

    /**
     * Test if an admin can view a participant.
     *
     * @return void
     */
    public function testAdminCanViewAParticipant()
    {
        $this->assertTrue($this->admin->can('view', $this->participant));
    }

    /**
     * Test if an admin can view any participant.
     *
     * @return void
     */
    public function testAdminCanViewAnyParticipant()
    {
        $this->assertTrue($this->admin->can('viewAny', $this->participant));
    }

    /**
     * Test if an admin can update a participant.
     *
     * @return void
     */
    public function testAdminCanUpdateAParticipant()
    {
        $this->assertTrue($this->admin->can('update', $this->participant));
    }

    /**
     * Test if an admin can delete a participant.
     *
     * @return void
     */
    public function testAdminCanDeleteAParticipant()
    {
        $this->assertTrue($this->admin->can('delete', $this->participant));
    }
}
