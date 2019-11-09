<?php

namespace Tests\Unit\Policies;

use App\Event;
use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @var \App\User */
    private $encoder;

    private $user;

    private $admin;

    /** @var \App\Event */
    private $event;

    /** @inheritDoc */
    protected function setUp(): void
    {
        parent::setUp();
        $this->encoder = factory(User::class)->states(['active', 'encoder'])->create();
        $this->user = factory(User::class)->state('active')->create();
        $this->admin = factory(User::class)->state('admin')->create();
        $this->event = factory(Event::class)->create();
    }

    /**
     * Test if an encoder can create an event.
     *
     * @return void
     */
    public function testEncoderCanCreateAnEvent()
    {
        $this->assertTrue($this->encoder->can('create', new Event()));
    }

    /**
     * Test if an encoder can view an event.
     *
     * @return void
     */
    public function testEncoderCanViewAnEvent()
    {
        $this->assertTrue($this->encoder->can('view', $this->event));
    }

    /**
     * Test if an encoder can view any event.
     *
     * @return void
     */
    public function testEncoderCanViewAnyEvent()
    {
        $this->assertTrue($this->encoder->can('viewAny', $this->event));
    }

    /**
     * Test if an encoder can update an event.
     *
     * @return void
     */
    public function testEncoderCanUpdateAnEvent()
    {
        $this->assertTrue($this->encoder->can('update', $this->event));
    }

    /**
     * Test if an encoder cannot delete an event.
     *
     * @return void
     */
    public function testEncoderCannotDeleteAnEvent()
    {
        $this->assertFalse($this->encoder->can('delete', $this->event));
    }

    /**
     * Test if a user cannot create an event.
     *
     * @return void
     */
    public function testUserCannotCreateAnEvent()
    {
        $this->assertFalse($this->user->can('create', new Event()));
    }

    /**
     * Test if a user can view an event.
     *
     * @return void
     */
    public function testUserCanViewAnEvent()
    {
        $this->assertTrue($this->user->can('view', $this->event));
    }

    /**
     * Test if a user can view any event.
     *
     * @return void
     */
    public function testUserCanViewAnyEvent()
    {
        $this->assertTrue($this->user->can('viewAny', $this->event));
    }

    /**
     * Test if a user cannot update an event.
     *
     * @return void
     */
    public function testUserCannotUpdateAnEvent()
    {
        $this->assertFalse($this->user->can('update', $this->event));
    }

    /**
     * Test if a user cannot delete an event.
     *
     * @return void
     */
    public function testUserCannotDeleteAnEvent()
    {
        $this->assertFalse($this->user->can('delete', $this->event));
    }

    /**
     * Test if an admin can create an event.
     *
     * @return void
     */
    public function testAdminCanCreateAnEvent()
    {
        $this->assertTrue($this->admin->can('create', new Event()));
    }

    /**
     * Test if an admin can view an event.
     *
     * @return void
     */
    public function testAdminCanViewAnEvent()
    {
        $this->assertTrue($this->admin->can('view', $this->event));
    }

    /**
     * Test if an admin can view any event.
     *
     * @return void
     */
    public function testAdminCanViewAnyParticipant()
    {
        $this->assertTrue($this->admin->can('viewAny', $this->event));
    }

    /**
     * Test if an admin can update an event.
     *
     * @return void
     */
    public function testAdminCanUpdateAnEvent()
    {
        $this->assertTrue($this->admin->can('update', $this->event));
    }

    /**
     * Test if an admin can delete an event.
     *
     * @return void
     */
    public function testAdminCanDeleteAnEvent()
    {
        $this->assertTrue($this->admin->can('delete', $this->event));
    }
}
