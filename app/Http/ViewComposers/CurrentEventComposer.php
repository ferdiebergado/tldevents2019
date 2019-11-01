<?php

namespace App\Http\ViewComposers;

use App\Event;
use Illuminate\View\View;

class CurrentEventComposer
{
    private $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function compose(View $view)
    {
        $id = auth()->id();
        $current_event = $this->event->where('created_by', $id)->where('is_active', true)->latest()->first();
        $view->with('current_event', $current_event);
    }
}
