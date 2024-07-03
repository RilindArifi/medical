<?php

namespace App\Traits;

trait Scopable
{
    public function scopeOnlyTrashedOrNot($query, $deleted)
    {
        return $deleted ? $query->onlyTrashed() : $query->withoutTrashed();
    }

    public function scopeSearchAny($query, $attributes, $search)
    {
        return $query->whereAny($attributes, 'LIKE',"%$search%");
    }
}
