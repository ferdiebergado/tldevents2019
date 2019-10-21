<?php

namespace App;

class Event extends BaseModel
{
    protected $fillable = [
        'title',
        'started_at',
        'ended_at'
    ];

    protected $casts = [
        'started_at',
        'ended_at'
    ];
}
