<?php

namespace Tests\Unit;

use Mockery;
use App\Participant;
use Tests\AbstractTestCase;

class CurrentEventComposerTest extends AbstractTestCase
{
    /** @var string */
    protected $view;

    /** @var string */
    protected $route;

    protected function setUp(): void
    {
        // SETUP:       parent
        parent::setUp();

        // SETUP:       View file to test
        $this->view = 'participant.index';

        // SETUP:       Temporary route which returns view page
        $this->route = 'phpunit/CurrentEventComposerTest';
        app('router')->get($this->route, [function () {
            return view($this->view, ['model' => factory(Participant::class)->create()]);
        }]);
    }

    public function testViewHasCurrentEvent()
    {
        $repo = Mockery::mock('App\Repositories\EventRepositoryInterface');
        $repo->shouldReceive('activeByAuthUser')->once()->andReturn($this->activeEvent->toArray());

        $currentEvent = $repo->activeByAuthUser();

        $this->get($this->route)->assertViewHas('currentEvent', $currentEvent);
    }
}
