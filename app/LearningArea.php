<?php

namespace App;

use App\Transaction;

class LearningArea extends BaseModel
{
    protected $fillable = [
        'name'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
