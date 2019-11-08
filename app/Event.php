<?php

namespace App;

use App\Assignment;
use App\Transaction;
use App\Util\Model\SearchableTrait;
use Illuminate\Support\Carbon;
use App\Util\Model\UserStampTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends BaseModel
{
    use SoftDeletes;
    use UserStampTrait;
    use SearchableTrait;

    private const TYPES = [
        'W' => 'Workshop/Writeshop',
        'T' => 'Training/Orientation',
        'C' => 'Conference/Summit'
    ];

    private const GROUPINGS = [
        'R' => 'By Region',
        'L' => 'By Learning Area',
        'M' => 'By Language',
        'N' => 'No Grouping'
    ];

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
        'is_active' => 'boolean',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'deleted_by' => 'integer'
    ];

    protected $appends = [
        'type_name',
        'grouping_name',
        'duration_date'
    ];

    protected $searchable = [
        'title'
    ];

    public function getStartedAtAttribute($value)
    {
        return Carbon::parse($value)->toDateString();
    }

    public function getEndedAtAttribute($value)
    {
        return Carbon::parse($value)->toDateString();
    }

    /**
     * get event grouping name
     */
    public function getGroupingNameAttribute()
    {
        return self::GROUPINGS[$this->attributes['grouping']];
    }

    /**
     * get event type name
     */
    public function getTypeNameAttribute()
    {
        return self::TYPES[$this->attributes['type']];
    }

    public function getDurationDateAttribute()
    {
        $started = Carbon::parse($this->attributes['started_at']);
        $ended = Carbon::parse($this->attributes['ended_at']);
        $duration = '';

        if ($started->month === $ended->month) {
            if ($started->day !== $ended->day) {
                $duration = $started->day . '-';
            }
        }

        if ($started->month < $ended->month) {
            $duration = $started->day . ' to ' . $ended->monthName . ' ';
        }

        return $started->monthName . ' ' . $duration . $ended->day . ', ' . $ended->year;
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
