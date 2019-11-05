<?php

namespace App;

use App\Transaction;
use App\Util\Model\SearchableTrait;
use App\Util\Model\UserStampTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends BaseModel
{
    use SoftDeletes;
    use UserStampTrait;
    use SearchableTrait;

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
        'email' => 'array',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'deleted_by' => 'integer'
    ];

    protected $searchable = [
        'last_name',
        'first_name',
        'station',
        'mobile',
        'email'
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
        return $this->stringify($value);
    }

    public function getEmailAttribute($value)
    {
        return $this->stringify($value);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    private function stringify($value)
    {
        if (null === $value) {
            return $value;
        }

        $str = json_decode($value);

        return implode(', ', (array) $str);
    }
}
