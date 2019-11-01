<?php

namespace App;

use App\Transaction;

class Language extends BaseModel
{
    protected $fillable = [
        'name'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
