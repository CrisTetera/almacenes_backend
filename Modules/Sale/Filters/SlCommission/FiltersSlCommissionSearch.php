<?php

namespace Modules\Sale\Filters\SlCommission;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersSlCommissionSearch Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        return $query->where(function (Builder $query) use ($value) {
            $value = strtolower($value);

            
            $query->orWhereRaw("LOWER(name) like '%$value%'");
            $query->orWhereRaw("LOWER(description) like '%$value%'");
        });
    }
}
