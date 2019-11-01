<?php

namespace App;

use App\Transaction;

class ParticipantRole extends BaseModel
{
    protected $fillable = [
        'name',
        'sequence'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
