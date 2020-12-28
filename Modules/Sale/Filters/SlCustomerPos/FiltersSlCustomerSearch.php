<?php

namespace Modules\Sale\Filters\SlCustomerPos;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersSlCustomerSearch Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        return $query->where(function (Builder $query) use ($value) {
            $value = strtolower($value);

            $query->orWhereRaw("LOWER(rut) like '%$value%'");
            $query->orWhereRaw("LOWER(business_name) like '%$value%'");
            $query->orWhereRaw("LOWER(alias_name) like '%$value%'");
        });
    }
}
