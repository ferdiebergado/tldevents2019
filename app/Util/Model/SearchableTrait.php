<?php

declare(strict_types=1);

namespace App\Util\Model;

use Illuminate\Database\Eloquent\Builder;

trait SearchableTrait
{
    /**
     * Scope a query to search model attributes for an array of string(s).
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param string $search
     * @throws \Exception
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $search): Builder
    {
        $words = $words = preg_split("/[\s,]+/", $search, -1, PREG_SPLIT_NO_EMPTY);

        if (null === $this->searchable) {
            throw new \Exception("\$searchable attribute not set.");
        }

        foreach ($words as $word) {
            foreach ($this->searchable as $field) {
                $query->orWhere($field, 'LIKE', '%' . $word . '%');
            }
        }

        return $query;
    }
}
