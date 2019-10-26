<?php

namespace App;

class Participant extends BaseModel
{
    protected $fillable = [
        'last_name',
        'first_name',
        'mi',
        'sex',
        'station',
        'mobile',
        'email'
    ];

    protected $casts = [
        'mobile' => 'array',
        'email' => 'array'
    ];

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucfirst($value);
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucfirst($value);
    }

    public function setMiAttribute($value)
    {
        $this->attributes['mi'] = strtoupper(str_replace('.', '', $value));
    }

    public function getMobileAttribute($value)
    {
        if (null === $value) {
            return $value;
        }

        return implode(', ', json_decode($value));
    }

    public function getEmailAttribute($value)
    {
        if (null === $value) {
            return $value;
        }

        return implode(', ', json_decode($value));
    }
}
