<?php

namespace App;

use App\Assignment;
use App\Transaction;
use Illuminate\Support\Carbon;
use App\Util\Model\UserStampTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends BaseModel
{
    use SoftDeletes;
    use UserStampTrait;

    protected $fillable = [
        'title',
        'started_at',
        'ended_at',
        'type',
        'grouping',
        'is_active'
    ];

    protected $casts = [
        'started_at' => 'date:Y-m-d',
        'ended_at' => 'date:Y-m-d',
        'is_active' => 'boolean'
    ];

    protected $appends = [
        'type_name',
        'grouping_name'
    ];

    public function getStartedAtAttribute($value)
    {
        return Carbon::parse($value)->toDateString();
    }

    public function getEndedAtAttribute($value)
    {
        return Carbon::parse($value)->toDateString();
    }

    public function getTypeNameAttribute()
    {
        switch ($this->attributes['type']) {
            case 'W':
                return 'Workshop/Writeshop';
                break;
            case 'T':
                return 'Training/Orientation';
                break;
            case 'C':
                return 'Conference/Summit';
                break;
        }
    }

    public function getGroupingNameAttribute()
    {
        switch ($this->attributes['grouping']) {
            case 'R':
                return 'By Region';
                break;
            case 'L':
                return 'By Learning Area';
                break;
            case 'M':
                return 'By Language';
                break;
            case 'N':
                return 'No Grouping';
                break;
        }
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
