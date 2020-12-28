<?php

namespace Modules\Warehouse\Filters\WhTag;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersWhTagSearch Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        return $query->where(function (Builder $query) use ($value) {
            $value = strtolower($value);

            
            $query->orWhereRaw("LOWER(tag) like '%$value%'");
            $query->orWhereRaw("LOWER(description) like '%$value%'");
        });
    }
}
