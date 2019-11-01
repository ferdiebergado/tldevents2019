<?php

namespace App;

use App\Event;
use App\Language;
use App\Participant;
use App\LearningArea;
use App\ParticipantRole;

class Transaction extends BaseModel
{
    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function role()
    {
        return $this->belongsTo(ParticipantRole::class);
    }

    public function learning_area()
    {
        return $this->belongsTo(LearningArea::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
