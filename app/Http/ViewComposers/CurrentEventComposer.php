<?php

namespace App\Http\ViewComposers;

use App\Repositories\EventRepositoryInterface;
use Illuminate\View\View;

class CurrentEventComposer
{
    private $event;

    public function __construct(EventRepositoryInterface $event)
    {
        $this->event = $event;
    }

    public function compose(View $view)
    {
        $currentEvent = $this->event->activeByAuthUser();
        if ($currentEvent) {
            $view->with('currentEvent', $currentEvent->toArray());
        }
    }
}
