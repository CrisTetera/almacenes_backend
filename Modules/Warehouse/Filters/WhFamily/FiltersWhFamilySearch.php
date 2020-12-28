<?php

namespace Modules\Warehouse\Filters\WhFamily;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersWhFamilySearch Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        return $query->where(function (Builder $query) use ($value) {
            $value = strtolower($value);

            
            $query->orWhereRaw("LOWER(family) like '%$value%'");
        });
    }
}
