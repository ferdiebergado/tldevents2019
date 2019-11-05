<?php

namespace App\Http\ViewComposers;

use App\Repositories\EventRepositoryInterface;
use Illuminate\View\View;

/** View Composer for the current active Event of the authenticated user. */
class CurrentEventComposer
{
    /** @var \App\Repositories\EventRepositoryInterface */
    private $event;

    /**
     * CurrentEventComposer Constructor
     *
     * @param EventRepositoryInterface $event
     */
    public function __construct(EventRepositoryInterface $event)
    {
        $this->event = $event;
    }

    /**
     * Compose the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $currentEvent = $this->event->activeByAuthUser();
        if ($currentEvent) {
            $view->with('currentEvent', $currentEvent->toArray());
        }
    }
}
