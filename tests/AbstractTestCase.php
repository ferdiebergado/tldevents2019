<?php

namespace Tests;

use App\User;
use App\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Abstract class to bootstrap tests.
 */
abstract class AbstractTestCase extends TestCase
{
    use RefreshDatabase;

    /** @var \App\User */
    protected $user;

    /** @var \App\Event */
    protected $activeEvent;

    /** @inheritDoc */
    protected function setUp(): void
    {
        parent::setUp();

        // Create a user with sufficient rights to access protected routes.
        $this->user = factory(User::class)->states(['encoder', 'active'])->create();

        // Then, authenticate the user into the application.
        $this->be($this->user);

        // Create an active event for the current authenticated user. 
        // (Required by the \App\Http\ViewComposers\CurrentEventComposer::class)        
        $this->activeEvent = factory(Event::class)->state('active')->create();
    }
}
