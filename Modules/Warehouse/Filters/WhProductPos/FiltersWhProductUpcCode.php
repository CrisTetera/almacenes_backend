<?php

namespace Modules\Warehouse\Filters\WhProductPos;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersWhProductUpcCode Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        return $query->where(function (Builder $query) use ($value) {
            $value = strtolower($value);

            $query->whereRaw("wh_product_pos.id IN
                              (SELECT id
                               FROM wh_product_pos
                               WHERE upc like '%$value%')");
        });
    }
}
