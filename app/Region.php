<?php

namespace App;

class Region extends BaseModel
{
    protected $fillable = [
        'name',
        'sequence',
        'area',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
