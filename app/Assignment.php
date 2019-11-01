<?php

namespace App;

use App\User;
use App\Event;

class Assignment extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
