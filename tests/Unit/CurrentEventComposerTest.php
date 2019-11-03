<?php

namespace Tests\Unit;

use App\User;
use App\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Repositories\EventEloquentRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CurrentEventComposerTest extends TestCase
{
    protected $route;
    protected $view;
    protected $user;

    protected function setUp(): void
    {
        // SETUP:       parent
        parent::setUp();

        $this->user = User::find(1);
        $this->be($this->user);

        // SETUP:       View file to test
        $this->view = 'participant.index';

        // SETUP:       Temporary route which returns view page
        $this->route = 'phpunit/CurrentEventComposerTest ';
        app('router')->get($this->route, [function () {
            return view($this->view);
        }]);
    }

    public function testViewHasCurrentEvent()
    {
        $repo = new EventEloquentRepository(new Event());
        $current = $repo->activeByAuthUser();
        $this->get($this->route)
            ->assertViewHas('current_event', $current);
    }
}
