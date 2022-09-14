<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class BaseRepository
{
    public function buildOrder(Builder $query, $orderBy = []): Builder
    {
        if (empty($orderBy)) return $query;

        foreach ($orderBy as $key => $val) {
            if (Str::upper($val) == 'DESC') {
                $query->orderByDesc($key);
            } else {
                $query->orderBy($key);
            }
        }
        return $query;
    }

}